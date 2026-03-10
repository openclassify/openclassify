# OpenClassify

OpenClassify is a modular classifieds marketplace built with Laravel 12 and Filament v5.

## Core Stack

- Laravel 12
- FilamentPHP v5
- `nwidart/laravel-modules`
- Blade + Tailwind + Vite
- Spatie Permission
- Laravel Reverb + Echo (realtime chat)

## Modules

All business features live in `Modules/*` (routes, services, models, resources, views, seeders).

Create a new module:

```bash
php artisan module:make ModuleName
```

Enable it in `modules_statuses.json`.

## Quick Start

### Docker

```bash
cp .env.example .env
docker compose up -d
```

App URLs:

- Frontend: `http://localhost:8000`
- Admin: `http://localhost:8000/admin`
- Panel: `http://localhost:8000/panel`

### Local

Requirements: PHP 8.2+, Composer, Node 18+, database server.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
composer run dev
```

## Seeded Accounts

| Role | Email | Password |
|------|-------|----------|
| Admin | `a@a.com` | `236330` |
| Member | `b@b.com` | `36330` |

## Demo Mode

Demo mode provisions a temporary, per-visitor marketplace schema.

Requirements:

- `DB_CONNECTION=pgsql`
- `DEMO=1`

Minimal `.env`:

```env
DEMO=1
DEMO_TTL_MINUTES=360
DEMO_SCHEMA_PREFIX=demo_
DEMO_COOKIE_NAME=oc2_demo
DEMO_LOGIN_EMAIL=a@a.com
DEMO_PUBLIC_SCHEMA=public
```

Commands:

```bash
php artisan demo:prepare
php artisan demo:cleanup
```

Notes:

- First guest homepage shows only `Prepare Demo`.
- `Prepare Demo` creates/reuses a private schema and logs in seeded admin.
- Expired demos are cleaned up automatically (hourly schedule).

## Realtime Chat (Reverb)

Set `.env`:

```env
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=app_id
REVERB_APP_KEY=app_key
REVERB_APP_SECRET=app_secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
REVERB_SERVER_HOST=0.0.0.0
REVERB_SERVER_PORT=8080
VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

Start:

```bash
composer run dev
```

Channel strategy:

- private channel: `users.{id}.inbox`
- events: `InboxMessageCreated`, `ConversationReadUpdated`

## Test and Build

```bash
php artisan test
php artisan optimize:clear
php artisan view:cache
```

## Production Checklist

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Contributors

- Website: [openclassify.com](https://openclassify.com)
- Package: [openclassify/openclassify](https://packagist.org/packages/openclassify/openclassify)
- Contributors: [GitHub graph](https://github.com/openclassify/openclassify/graphs/contributors)
