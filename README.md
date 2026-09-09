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
git commit + git tag v1.x.x + git push origin main --tags
       ↓
GitHub Actions automatically builds ojis-travels-theme.zip and publishes a Release
       ↓
WordPress checks GitHub every 12 hours
       ↓
"Update Available" appears in Appearance → Themes on EVERY site running the theme
       ↓
Click Update — WordPress downloads and installs the new version automatically
```

**No wp-config.php required.** The updater is built into the theme and works on any WordPress site with zero configuration. Just install the theme ZIP and updates are detected automatically.

---

## Installing on a New WordPress Site

1. Download the latest `ojis-travels-theme.zip` from the [Releases page](https://github.com/ezeroandone/ojis-travels-theme/releases)
2. In WordPress: **Appearance → Themes → Add New → Upload Theme**
3. Upload the ZIP → Activate
4. Done — future updates appear automatically in **Appearance → Themes**

No wp-config.php edits, no plugin installs, no API keys.

---

## Releasing an Update (push to all sites at once)

```bash
# 1. Edit theme files locally

# 2. Bump the version in style.css
#    Example:  Version: 1.0.0  →  Version: 1.0.1

# 3. Commit, tag, and push
git add -A
git commit -m "v1.0.1: describe what changed"
git tag v1.0.1
git push origin main --tags
```

That's it. GitHub Actions builds the ZIP and creates the release. WordPress sites running the theme detect the new version within 12 hours (or immediately via **Dashboard → Updates → Check Again**).

---

## Finding wp-config.php on Hostinger

If you ever need to edit `wp-config.php` on Hostinger:

1. Log in to **hPanel** (your Hostinger control panel)
2. Go to **Files → File Manager**
3. Navigate to `public_html/` (your WordPress root)
4. `wp-config.php` is there — Hostinger sometimes hides it by default. Click the **Settings / Show Hidden Files** toggle in the File Manager toolbar to reveal it.

Alternatively, connect via FTP:
- Host: `ftp.yourdomain.com`
- Credentials: found in hPanel → **Hosting → FTP Accounts**

---

## Local Development Workflow

```bash
# Clone the repo
git clone https://github.com/ezeroandone/ojis-travels-theme.git

# Edit files in your local WordPress themes folder or symlink:
# wp-content/themes/ojis-travels-theme → this repo folder

# Push changes
git add -A
git commit -m "description"
git push origin main
# (bump version + tag only when you want to trigger an update on live sites)
```

---

## Theme Structure

```
ojis-travels-theme/
├── style.css              ← Theme header — Version: lives here
├── functions.php          ← Setup, enqueue, Customizer, AJAX, newsletter
├── header.php             ← Sticky glassmorphism header + dual logo swap
├── footer.php             ← 4-column dark footer
├── front-page.php         ← Homepage template
├── single.php             ← Single post template
├── page.php               ← Generic page template
├── page-about.php         ← About Us
├── page-services.php      ← Services
├── page-insights.php      ← Insights / Blog
├── page-contact.php       ← Contact / Advisory
├── index.php              ← Archive / search fallback
├── inc/
│   ├── github-updater.php ← Zero-config WordPress update checker (GitHub)
│   ├── seo.php            ← Meta tags, OG, Twitter card, Schema.org, Sitemap
│   ├── analytics.php      ← Built-in visitor analytics dashboard
│   └── social-icons.php   ← Inline SVG social media icons
├── assets/
│   ├── css/main.css       ← Design tokens, components, animations
│   ├── js/main.js         ← Scroll, logo swap, counters, forms
│   └── images/
└── .github/
    └── workflows/
        └── release.yml    ← Auto-builds ZIP on version tag push
```

---

*Built with progress over perfection — eZeroAndOne.io*
