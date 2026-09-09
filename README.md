# AriaSazeh Luxury Construction CMS

A portfolio-grade **Persian RTL luxury construction website and CMS** built with **Laravel 13**, **PHP 8.4**, **Blade**, custom CSS and lightweight vanilla JavaScript.

No React. No Tailwind. No admin-theme dependency.

## Project purpose

This repository demonstrates a complete Laravel full-stack implementation for a premium construction and real-estate company: luxury residential towers, villas, modern homes, project showcases, lead capture, content management and a custom administration panel.

## Stack

- Laravel 13 / PHP 8.4
- Blade templates
- Custom responsive RTL CSS
- Vanilla JavaScript
- Vite 8
- SQLite by default; MySQL-ready
- PHPUnit 12
- GitHub Actions CI

## Public website

- Luxury construction homepage with local visual assets
- Mouse parallax and subtle project-card tilt on fine-pointer devices
- About and team pages
- Services listing and detail pages
- Projects with search/category filters and detail pages
- Insights / articles
- Contact and lead capture
- Dynamic `sitemap.xml` and `robots.txt`
- Canonical, Open Graph, Twitter Card and structured-data metadata
- `GeneralContractor`, Article and breadcrumb schema support
- Persian RTL, responsive and keyboard-friendly UI
- `prefers-reduced-motion` support

## Administration

- Secure session authentication
- Admin-only middleware
- Dashboard statistics and recent enquiries
- Generic reusable CRUD engine
- Services management
- Construction project management
- Articles management
- Team management
- Testimonials management
- Contact-message inbox
- Site copy and SEO settings
- Image upload support

## Performance approach

The UI avoids frontend frameworks, external icon libraries and third-party font CDNs. Visual assets are served locally, CSS/JavaScript are bundled with Vite, images use explicit dimensions where appropriate, non-critical images are lazy-loaded, and parallax/tilt effects run only on fine-pointer devices. Site settings and homepage data are cached.

A Lighthouse score depends on the final server, network, production image payloads and deployment configuration. Run Lighthouse against the deployed production URL before claiming a fixed score.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
npm install --no-audit --no-fund
npm run build
php artisan serve
```

Set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env` **before** running the seeder and replace all example credentials before deployment.

## Production checklist

```bash
composer install --no-dev --optimize-autoloader
npm install --no-audit --no-fund
npm run build
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Use HTTPS, set `APP_ENV=production`, `APP_DEBUG=false`, configure the production database, use a strong administrator password, and configure the web server to serve only the `public/` directory.

For fully reproducible production dependency installs, generate and commit `composer.lock` and `package-lock.json`, then use lockfile-based install commands in CI/deployment.

## Architecture notes

`config/cms.php` defines reusable admin resources and validation rules. `Admin\\CmsController` provides the shared CRUD workflow while each domain uses a normal Eloquent model. This keeps the administration compact without sacrificing Laravel conventions.

Public content controllers are separate from administration. Route-model binding uses slugs for services, projects and posts. The contact form includes rate limiting and a honeypot field. Filtered project URLs are marked `noindex,follow` to reduce duplicate indexed pages while canonical URLs remain clean.

## CI

Every push and pull request validates Composer, installs PHP 8.4 dependencies, builds production frontend assets and runs Laravel feature tests.

---

Built as a polished Laravel/Blade portfolio project for a luxury construction company.
