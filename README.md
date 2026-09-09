# OJIS Travels Theme

Custom WordPress theme for **OJIS Travels & Advisory** — a sustainable tourism and hospitality brand.

**Developer:** [Opeyemi Oladejobi Akinkunmi](https://ezeroandone.io) — eZeroAndOne.io  
**Client:** OJIS Travels & Advisory — [ojistravels.com](https://ojistravels.com)  
**Repository:** [github.com/ezeroandone/ojis-travels-theme](https://github.com/ezeroandone/ojis-travels-theme)

---

## How the GitHub → WordPress Update Flow Works

```
You edit theme files  →  bump Version in style.css
       ↓
git tag v1.x.x  →  git push origin v1.x.x
       ↓
GitHub Actions builds the ZIP and creates a Release
       ↓
WordPress fetches the new version number from GitHub (every 12 hours)
       ↓
"Update Available" appears in Appearance → Themes
       ↓
Click Update — WordPress downloads and installs the ZIP
```

---

## Setup (one-time)

### 1. Repository

The repo is already live at: **https://github.com/ezeroandone/ojis-travels-theme**

```bash
# To clone on a new machine:
git clone https://github.com/ezeroandone/ojis-travels-theme.git
```

### 2. Tell WordPress where to find updates

Add these lines to your site's **wp-config.php** (above `/* That's all, stop editing! */`):

```php
define( 'OJIS_GH_USER',       'YOUR_GITHUB_USERNAME' );   // ← replace this
define( 'OJIS_GH_REPO',       'ojis-travels-theme' );
define( 'OJIS_GH_BRANCH',     'main' );
define( 'OJIS_GH_TOKEN',      '' );      // leave blank for public repos
define( 'OJIS_GH_USE_BRANCH', true );    // true = use branch ZIP (no release needed)
```

> **Private repo?** Generate a GitHub Personal Access Token (PAT) with `repo` scope and set `OJIS_GH_TOKEN` to it.

### 3. That's it

The theme's built-in `inc/github-updater.php` reads these constants and handles everything else automatically.

---

## Releasing an Update

Every time you want WordPress to prompt users to update:

```bash
# 1. Make your changes, then bump the version in style.css
#    Change:  Version: 1.0.0
#    To:      Version: 1.0.1   (or 1.1.0 for minor, 2.0.0 for major)

# 2. Stage and commit
git add -A
git commit -m "v1.0.1: describe what changed"

# 3. Tag the release — this triggers the GitHub Actions workflow
git tag v1.0.1
git push origin main --tags
```

GitHub Actions then:
1. Reads the version from `style.css`
2. Builds `ojis-travels-theme.zip`
3. Creates a GitHub Release with the ZIP attached

WordPress checks for updates every 12 hours. To force an immediate check: go to **Dashboard → Updates** and click **Check Again**.

---

## Local Development

Edit files directly in `c:\Users\hp\OneDrive\Documents\Ojis\ojis-travels-theme\` and copy/sync to your WordPress `wp-content/themes/` folder, or symlink it.

---

## Theme Structure

```
ojis-travels-theme/
├── style.css              ← Theme header (version lives here)
├── functions.php          ← Setup, enqueue, Customizer, AJAX, newsletter
├── header.php             ← Sticky glassmorphism header + dual logo
├── footer.php             ← 4-column dark footer
├── front-page.php         ← Homepage template
├── page.php               ← Generic page template
├── page-about.php         ← About Us template
├── page-services.php      ← Services template
├── page-insights.php      ← Insights / Blog template
├── page-contact.php       ← Contact / Advisory Inquiry template
├── index.php              ← Archive / search fallback
├── inc/
│   ├── github-updater.php ← Handles WordPress update checks from GitHub
│   └── social-icons.php   ← Inline SVG social media icons
├── assets/
│   ├── css/main.css       ← Design tokens, components, animations
│   ├── js/main.js         ← Scroll behaviour, logo swap, counters, forms
│   └── images/            ← Theme images and logos
└── .github/
    └── workflows/
        └── release.yml    ← Auto-builds release ZIP on version tag push
```

---

*Built with progress over perfection.*
