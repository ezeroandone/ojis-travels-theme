<?php
/**
 * OJIS Travels Theme — GitHub Updater
 *
 * Checks the GitHub repository for a newer version of this theme and surfaces
 * the standard WordPress "Update Available" notice in the dashboard.
 *
 * ZERO CONFIGURATION REQUIRED.
 * Install the theme on any WordPress site and updates will be detected
 * automatically from github.com/ezeroandone/ojis-travels-theme.
 *
 * How it works:
 *  1. WordPress calls pre_set_site_transient_update_themes on a schedule.
 *  2. This class fetches the raw style.css from the GitHub repo's main branch.
 *  3. It reads the "Version:" header from that file.
 *  4. If the remote version is higher than the installed version, WordPress shows
 *     the update notice in Appearance → Themes. Clicking "Update" downloads
 *     and installs the new version automatically.
 *
 * To trigger an update on any site:
 *  1. Edit files locally.
 *  2. Bump "Version:" in style.css (e.g. 1.0.0 → 1.0.1).
 *  3. git commit + git tag v1.0.1 + git push origin main --tags
 *  4. WordPress detects the new version within 12 hours (or immediately via
 *     Dashboard → Updates → Check Again).
 *
 * Optional overrides via wp-config.php (only needed for private repos or forks):
 *   define( 'OJIS_GH_USER',       'different-username' );
 *   define( 'OJIS_GH_REPO',       'different-repo-name' );
 *   define( 'OJIS_GH_BRANCH',     'main' );
 *   define( 'OJIS_GH_TOKEN',      'ghp_xxx' );  // only for PRIVATE repos
 *   define( 'OJIS_GH_USE_BRANCH', true );
 *
 * @package ojis-travels-theme
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class OJIS_GitHub_Updater {

    /** GitHub repository owner (username or org) */
    private string $user;

    /** GitHub repository name */
    private string $repo;

    /** Branch to track */
    private string $branch;

    /** Optional Personal Access Token for private repos */
    private string $token;

    /** Whether to use branch ZIP instead of a release tag */
    private bool $use_branch;

    /** WordPress theme slug (folder name) */
    private string $theme_slug;

    /** Currently installed version */
    private string $current_version;

    /** Transient key — unique per repo so multiple themes can coexist */
    private string $transient_key;

    public function __construct() {
        $this->user            = defined( 'OJIS_GH_USER' )       ? OJIS_GH_USER       : 'ezeroandone';
        $this->repo            = defined( 'OJIS_GH_REPO' )       ? OJIS_GH_REPO       : 'ojis-travels-theme';
        $this->branch          = defined( 'OJIS_GH_BRANCH' )     ? OJIS_GH_BRANCH     : 'main';
        $this->token           = defined( 'OJIS_GH_TOKEN' )      ? OJIS_GH_TOKEN      : '';
        $this->use_branch      = defined( 'OJIS_GH_USE_BRANCH' ) ? OJIS_GH_USE_BRANCH : true;
        $this->theme_slug      = get_template(); // 'ojis-travels-theme'
        $this->current_version = wp_get_theme( $this->theme_slug )->get( 'Version' );
        $this->transient_key   = 'ojis_gh_update_' . md5( $this->user . $this->repo );

        add_filter( 'pre_set_site_transient_update_themes', [ $this, 'check_for_update' ] );
        add_filter( 'themes_api',                           [ $this, 'theme_info' ], 10, 3 );
        add_action( 'upgrader_process_complete',            [ $this, 'purge_transient' ], 10, 2 );
    }

    // ─── Check for update ─────────────────────────────────────────────────────
    public function check_for_update( $transient ) {
        if ( empty( $transient->checked ) ) return $transient;

        $remote = $this->get_remote_data();
        if ( ! $remote ) return $transient;

        if ( version_compare( $this->current_version, $remote['version'], '<' ) ) {
            $transient->response[ $this->theme_slug ] = [
                'theme'       => $this->theme_slug,
                'new_version' => $remote['version'],
                'url'         => $remote['url'],
                'package'     => $remote['zip_url'],
                'requires'    => '6.0',
                'requires_php'=> '8.0',
            ];
        } else {
            // Tell WordPress this theme is up to date
            $transient->no_update[ $this->theme_slug ] = [
                'theme'       => $this->theme_slug,
                'new_version' => $this->current_version,
                'url'         => $remote['url'],
            ];
        }

        return $transient;
    }

    // ─── Theme info popup (the "View version x.x details" modal) ─────────────
    public function theme_info( $result, $action, $args ) {
        if ( $action !== 'theme_information' ) return $result;
        if ( ! isset( $args->slug ) || $args->slug !== $this->theme_slug ) return $result;

        $remote = $this->get_remote_data();
        if ( ! $remote ) return $result;

        return (object) [
            'name'          => 'OJIS Travels Theme',
            'slug'          => $this->theme_slug,
            'version'       => $remote['version'],
            'author'        => '<a href="https://ezeroandone.io">Opeyemi Oladejobi Akinkunmi — eZeroAndOne.io</a>',
            'homepage'      => $remote['url'],
            'download_link' => $remote['zip_url'],
            'last_updated'  => $remote['updated'] ?? '',
            'sections'      => [
                'description' => 'Custom WordPress theme for OJIS Travels & Advisory. Developed by <a href="https://ezeroandone.io">eZeroAndOne.io</a>.',
                'changelog'   => $remote['changelog'] ?? 'See the <a href="' . esc_url( $remote['url'] ) . '/releases">GitHub releases page</a> for change notes.',
            ],
        ];
    }

    // ─── Purge cached data after an update ────────────────────────────────────
    public function purge_transient( $upgrader, $options ): void {
        if (
            $options['action'] === 'update' &&
            $options['type']   === 'theme'  &&
            isset( $options['themes'] ) &&
            in_array( $this->theme_slug, (array) $options['themes'], true )
        ) {
            delete_transient( $this->transient_key );
        }
    }

    // ─── Fetch remote version data (cached for 12 hours) ─────────────────────
    private function get_remote_data(): array|false {
        $cached = get_transient( $this->transient_key );
        if ( $cached !== false ) return $cached;

        // Fetch style.css from GitHub raw to read the Version header
        $style_url = sprintf(
            'https://raw.githubusercontent.com/%s/%s/%s/style.css',
            rawurlencode( $this->user ),
            rawurlencode( $this->repo ),
            rawurlencode( $this->branch )
        );

        $response = $this->remote_get( $style_url );
        if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
            return false;
        }

        $body    = wp_remote_retrieve_body( $response );
        $version = $this->parse_header( $body, 'Version' );

        if ( empty( $version ) ) return false;

        // Build the download URL
        if ( $this->use_branch ) {
            // Download the branch as a ZIP — GitHub serves this even for public repos
            $zip_url = sprintf(
                'https://github.com/%s/%s/archive/refs/heads/%s.zip',
                rawurlencode( $this->user ),
                rawurlencode( $this->repo ),
                rawurlencode( $this->branch )
            );
        } else {
            // Use the latest release ZIP from the GitHub API
            $zip_url = $this->get_latest_release_zip();
            if ( ! $zip_url ) {
                // Fall back to branch ZIP
                $zip_url = sprintf(
                    'https://github.com/%s/%s/archive/refs/heads/%s.zip',
                    rawurlencode( $this->user ),
                    rawurlencode( $this->repo ),
                    rawurlencode( $this->branch )
                );
            }
        }

        $repo_url = sprintf( 'https://github.com/%s/%s', $this->user, $this->repo );

        $data = [
            'version' => $version,
            'zip_url' => $zip_url,
            'url'     => $repo_url,
            'updated' => current_time( 'Y-m-d' ),
        ];

        set_transient( $this->transient_key, $data, 12 * HOUR_IN_SECONDS );
        return $data;
    }

    // ─── Get latest release ZIP URL from GitHub API ───────────────────────────
    private function get_latest_release_zip(): string|false {
        $api_url  = sprintf(
            'https://api.github.com/repos/%s/%s/releases/latest',
            rawurlencode( $this->user ),
            rawurlencode( $this->repo )
        );
        $response = $this->remote_get( $api_url );

        if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
            return false;
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        return $body['zipball_url'] ?? false;
    }

    // ─── Parse a theme file header ────────────────────────────────────────────
    private function parse_header( string $content, string $header ): string {
        if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $header, '/' ) . ':(.*)$/mi', $content, $matches ) ) {
            return trim( $matches[1] );
        }
        return '';
    }

    // ─── Authenticated wp_remote_get wrapper ─────────────────────────────────
    private function remote_get( string $url ) {
        $args = [
            'timeout'    => 15,
            'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
            'headers'    => [],
        ];

        if ( ! empty( $this->token ) ) {
            $args['headers']['Authorization'] = 'Bearer ' . $this->token;
        }

        return wp_remote_get( $url, $args );
    }
}

// Boot the updater — only in admin context to avoid front-end overhead
if ( is_admin() ) {
    new OJIS_GitHub_Updater();
}
