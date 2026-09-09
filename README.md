# Northstar Corporate CMS

A portfolio-grade, multi-purpose corporate website and content management system built with **Laravel 13**, **PHP 8.4**, **Blade**, custom CSS and lightweight vanilla JavaScript.

No React. No Tailwind. No admin theme dependency.

## Why this project exists

This repository demonstrates a complete Laravel full-stack implementation rather than a static template: public corporate pages, a custom administration experience, reusable CMS resources, SEO infrastructure, database-backed enquiries and automated testing.

## Stack

- Laravel 13 / PHP 8.4
- Blade templates
- Custom responsive CSS
- Vanilla JavaScript
- Vite 7
- SQLite by default; MySQL-ready
- PHPUnit 12
- GitHub Actions CI

## Public website

- High-impact corporate homepage
- About / leadership page
- Services listing and detail pages
- Portfolio / case studies
- Insights / articles
- Contact and lead capture
- Dynamic sitemap.xml and robots.txt
- Canonical, Open Graph and organization schema metadata
- Responsive, semantic and keyboard-friendly UI

## Administration

- Secure session authentication
- Admin-only middleware
- Dashboard statistics and recent enquiries
- Generic reusable CRUD engine
- Services management
- Projects management
- Articles management
- Team management
- Testimonials management
- Contact message inbox
- Site copy and SEO settings
- Image upload support

## Performance approach

The UI intentionally avoids external fonts, icon libraries, JavaScript frameworks and CSS frameworks. Assets are bundled locally through Vite. Content images use explicit dimensions and lazy loading where appropriate. Site settings and homepage data are cached.

A Lighthouse score depends on the final server, network, image payloads and production configuration, so run Lighthouse against the deployed production URL before claiming a specific score.

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env` **before** running the seeder. Change the example credentials first.

## Production checklist

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Use HTTPS, set `APP_ENV=production`, `APP_DEBUG=false`, configure the production database, use a strong administrator password, and configure your web server to serve only the `public/` directory.

## Architecture notes

`config/cms.php` defines reusable admin resources and validation rules. `Admin\\CmsController` provides the shared CRUD workflow while each domain uses a normal Eloquent model. This keeps the admin compact without sacrificing Laravel conventions.

Public content controllers are deliberately separate from administration. Route-model binding uses slugs for services, projects and posts. The public contact form includes rate limiting and a honeypot field.

## CI

Every push and pull request runs Composer validation, PHP 8.4 dependency installation, the Vite production build and Laravel tests.

---

Built as a reusable corporate foundation and as a demonstrable Laravel/Blade portfolio project.
