# Elemental Addons — WordPress.org & Envato Template Kit Plan

Do this in order: **WordPress.org first**, then Envato kits. A kit cannot depend on Elemental Addons until the plugin is **public and approved** on wordpress.org.

---

## 1) WordPress.org — get Elemental Addons approved

**Goal:** a clean, reviewable free Elementor addon (no Evolta / theme lock-in).

### 1. Finish product polish

- Set `Contributors:` in `readme.txt` to your real wordpress.org username
- Fill `Tested up to`, short description, FAQ, changelog
- Confirm every widget works on **Hello Elementor** only (plus Elementor)
- Fix any PHP notices/warnings in `debug.log`

### 2. WordPress.org compliance pass

- GPL assets only (LightGallery + Isotope already noted in `readme.txt`)
- Proper escaping/sanitizing, prefixed functions/handles
- No remote license checks, no “buy pro” that blocks core features
- No bundling of other plugins; Contact Form 7 stays optional
- Soften Evolta-specific wording in the Converter UI (“Layout Converter”, not Evolta-only)

### 3. Package

- Zip only the `elemental-addons` folder (not the whole plugins directory)
- No `node_modules`, no large unused SCSS/source trees if not needed for the release

### 4. Submit

- Create / log in at wordpress.org → Plugin Developer → Add Plugin
- Wait for review (often days–weeks; respond quickly to tickets)

### 5. After approval

- Publish the first release (SVN / deploy tooling)
- Install from wordpress.org on a clean site and re-test once

Until this is live, **do not** submit Envato kits that depend on Elemental Addons.

---

## 2) Envato Template Kit — after the plugin is live

**Goal:** kits that use Hello Elementor + Elementor Pro + your **wordpress.org** free plugin only.

### 1. Build environment

- Fresh site
- Theme: **Hello Elementor**
- Plugins: **Elementor**, **Elementor Pro**, **Elemental Addons** (from wordpress.org)
- Optional: Contact Form 7 only if the kit needs forms
- Do **not** use the Evolta theme or `mascot-core-*`

### 2. Follow Envato kit rules (strict)

Official reference: [WordPress Template Kit Requirements](https://help.author.envato.com/hc/en-us/articles/360038151251-WordPress-Template-Kit-Requirements)

- Use Envato’s Template Kit Export workflow
- At least **10** templates (pages/sections as required)
- **No** Custom CSS, Custom HTML, custom IDs/classes
- Prefer Elementor native + Elemental Addons widgets
- Avoid anything not on wordpress.org (except Elementor Pro, which Envato allows)
- Use dynamic content where required (Featured Image, Post Title, etc.)
- Follow naming, thumbnails, and live preview rules

### 3. Workflow tip (converter)

- Use Evolta layouts only as a **starting point** via Tools → Elemental Converter
- Then clean in Elementor: remove leftover theme styles, replace edge-case markup, ensure no Custom CSS/HTML
- Rebuild kits niche-by-niche (each kit is a separate Envato item with the same rules)

### 4. Submit on Envato

- Export the kit zip via their export plugin
- Live preview site must run Hello + approved plugins only
- Submit under Template Kits; fix reviewer notes quickly

---

## Practical “what next this week”

| Order | Action |
|------:|--------|
| 1 | Hard QA of Elemental Addons on Hello Elementor |
| 2 | Fix `readme.txt` contributor + packaging |
| 3 | Submit plugin to wordpress.org |
| 4 | While waiting: design kit structure / niches (do not submit kits yet) |
| 5 | After .org is live: build first kit (1 niche, ≥10 templates) and submit to Envato |

---

## Notes

- Widget type IDs stay as `tm-ele-*` so Evolta layouts convert/paste cleanly into Hello + Elemental Addons.
- The layout converter is for internal speed; Envato reviewers must only see a clean kit that uses wordpress.org plugins + Elementor Pro.
