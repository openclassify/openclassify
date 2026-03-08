# OpenClassify

A modern classified ads platform built with Laravel 12, FilamentPHP v5, and Laravel Modules — similar to Letgo and Sahibinden.

## Features

- 🛍️ **Classified Listings** — Browse, search, and post ads across categories
- 🗂️ **Categories** — Hierarchical categories with icons
- 📍 **Locations** — Country and city management
- 👤 **User Profiles** — Manage your listings and account
- 🔐 **Admin Panel** — Full control via FilamentPHP v5 at `/admin`
- 🧭 **Frontend Panel** — Authenticated users manage listings, profile, videos, favorites, and inbox at `/panel`
- 🧪 **Demo Mode** — Per-visitor PostgreSQL schema provisioning with seeded data and automatic cleanup
- 🌍 **10 Languages** — English, Turkish, Arabic, German, French, Spanish, Portuguese, Russian, Chinese, Japanese
- 🐳 **Docker Ready** — One-command production and development setup
- ☁️ **GitHub Codespaces** — Zero-config cloud development


## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 12 |
| Admin UI | FilamentPHP v5 |
| Modules | nWidart/laravel-modules v11 |
| Auth/Roles | Spatie Laravel Permission |
| Frontend | Blade + TailwindCSS + Vite |
| Database | PostgreSQL (required for demo mode) |
| Cache/Queue | Database or Redis |

## Quick Start (Docker)

```bash
# Clone the repository
git clone https://github.com/openclassify/openclassify.git
cd openclassify

# Copy environment file
cp .env.example .env

# Start with Docker Compose (production-like)
docker compose up -d

# The application will be available at http://localhost:8000
```

### Default Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | a@a.com | 236330 |
| Member | b@b.com | 36330 |

These accounts are seeded by `Modules\User\Database\Seeders\AuthUserSeeder`. In demo mode, demo preparation still auto-logs the visitor into the schema-local admin account.

**Admin Panel:** http://localhost:8000/admin
**Frontend Panel:** http://localhost:8000/panel

---

## Development Setup

### Option 1: GitHub Codespaces (Zero Config)

1. Click **Code → Codespaces → New codespace** on GitHub
2. Wait for the environment to build (~2 minutes)
3. The app starts automatically at port 8000

### Option 2: Docker Development

```bash
# Start development environment with hot reload
docker compose -f docker-compose.dev.yml up -d

# View logs
docker compose -f docker-compose.dev.yml logs -f app
```

### Option 3: Local (PHP + Node)

**Requirements:** PHP 8.2+, Composer, Node 18+, PostgreSQL for demo mode

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database (SQLite for quick start)
touch database/database.sqlite
php artisan migrate
php artisan db:seed

# Start all services (server + queue + vite)
composer run dev
```

## Demo Mode

Demo mode is designed for isolated visitor sessions. When enabled, each visitor can provision a private temporary marketplace backed by its own PostgreSQL schema.

### Requirements

- `DB_CONNECTION=pgsql`
- `DEMO=1`
- database-backed session / cache / queue drivers are supported and will stay on the public schema via `pgsql_public`

If `DEMO=1` is set while the app is not using PostgreSQL, the application fails fast during boot.

### Runtime Behavior

- On the first guest homepage visit, the primary visible CTA is a single large `Prepare Demo` button.
- The homepage shows how long the temporary demo will live before automatic deletion.
- Clicking `Prepare Demo` provisions a visitor-specific schema, runs `migrate` and `db:seed`, and logs the visitor into the seeded admin account.
- The same browser reuses its active demo instead of creating duplicate schemas.
- Demo lifetime defaults to `360` minutes from explicit prepare / reopen time.
- Expired demos are removed by `demo:cleanup`, which is scheduled hourly.

### Environment

```env
DB_CONNECTION=pgsql
DEMO=1
DEMO_TTL_MINUTES=360
DEMO_SCHEMA_PREFIX=demo_
DEMO_COOKIE_NAME=oc2_demo
DEMO_LOGIN_EMAIL=a@a.com
DEMO_PUBLIC_SCHEMA=public
```

### Commands

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan demo:prepare
php artisan demo:cleanup
```

### Panels

| Panel | URL | Access |
|-------|-----|--------|
| Admin | `/admin` | Users with `admin` role |
| Frontend Panel | `/panel` | All authenticated users |

### Roles (Spatie Permission)

| Role | Access |
|------|--------|
| `admin` | Full admin panel access |

---

## Code Contributors

<p align="center">
  <a href="https://openclassify.com">
    <img src="https://raw.githubusercontent.com/openclassify/openclassify/master/public/openclassify-logo.png" width="220" alt="OpenClassify Logo">
  </a>
</p>

OpenClassify is a modular open source classified platform built with Laravel.

- Website: [openclassify.com](https://openclassify.com)
- Package: [openclassify/openclassify](https://packagist.org/packages/openclassify/openclassify)

This project is maintained and improved by its contributors.

<p align="center">
  <a href="https://github.com/openclassify/openclassify/graphs/contributors">
    <img src="https://contrib.rocks/image?repo=openclassify/openclassify" alt="OpenClassify Contributors">
  </a>
</p>

## Creating a New Module

```bash
php artisan module:make ModuleName
```

Then add to `modules_statuses.json`:
```json
{
    "ModuleName": true
}
```

---

## Adding a Filament Resource to Admin Panel

Resources are auto-discovered from `Modules/Admin/Filament/Resources/`.

---

## Language Support

Languages are in `lang/{locale}/messages.php`. To add a new language:

1. Create `lang/{locale}/messages.php`
2. Switch language via: `GET /lang/{locale}`

Supported locales: `en`, `tr`, `ar`, `de`, `fr`, `es`, `pt`, `ru`, `zh`, `ja`

---

## Running Tests

```bash
php artisan test
```

---

## Production Deployment

### Environment Variables

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=openclassify
DB_USERNAME=openclassify
DB_PASSWORD=your-secure-password

REDIS_HOST=your-redis-host
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### Post-Deploy Commands

```bash
php artisan migrate --force
php artisan db:seed --force    # Only on first deploy
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```