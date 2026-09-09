# AriaSazeh Luxury Construction CMS

A portfolio-grade **Persian RTL luxury construction website and CMS** built with **Laravel 13**, **PHP 8.4**, **Blade**, custom CSS and lightweight vanilla JavaScript.

No React. No Tailwind. No Vite. No Node.js build step. No admin-theme dependency.

## Stack

- Laravel 13 / PHP 8.4
- Blade templates
- Custom responsive RTL CSS served directly from `public/assets/css/app.css`
- Vanilla JavaScript served directly from `public/assets/js/app.js`
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
- Services, projects, articles, team and testimonials management
- Contact-message inbox
- Site copy and SEO settings
- Image upload support

## Frontend asset strategy

There is no frontend bundler. CSS and JavaScript are intentionally committed as production-ready static assets under `public/assets/` and linked directly from Blade. This keeps deployment simple and removes Node.js/Vite from the runtime and CI pipeline.

The project also avoids frontend frameworks, external icon libraries and third-party font CDNs. Images use explicit dimensions where appropriate, non-critical images are lazy-loaded, and parallax/tilt effects run only on fine-pointer devices.

A Lighthouse score depends on the final server, network, image payloads and deployment configuration. Run Lighthouse against the deployed production URL before claiming a fixed score.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env` before running the seeder and replace all example credentials before deployment.

## Production checklist

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Use HTTPS, set `APP_ENV=production`, `APP_DEBUG=false`, configure the production database, use a strong administrator password, and configure the web server to serve only the `public/` directory.

## Architecture notes

`config/cms.php` defines reusable admin resources and validation rules. `Admin\\CmsController` provides the shared CRUD workflow while each domain uses a normal Eloquent model. Public content controllers remain separate from administration. Route-model binding uses slugs for services, projects and posts. The contact form includes rate limiting and a honeypot field. Filtered project URLs are marked `noindex,follow` to reduce duplicate indexed pages while canonical URLs remain clean.

## CI

Every push and pull request validates Composer, installs PHP 8.4 dependencies, prepares Laravel and runs the automated feature tests. No Node.js or Vite stage is required.

---

Built as a polished Laravel/Blade portfolio project for a luxury construction company.
