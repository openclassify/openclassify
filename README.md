# OpenClassify

A modern classified ads platform built with Laravel 12, FilamentPHP v5, and Laravel Modules — similar to Letgo and Sahibinden.

## Features

- 🛍️ **Classified Listings** — Browse, search, and post ads across categories
- 🗂️ **Categories** — Hierarchical categories with icons
- 📍 **Locations** — Country and city management
- 👤 **User Profiles** — Manage your listings and account
- 🔐 **Admin Panel** — Full control via FilamentPHP v5 at `/admin`
- 🤝 **Partner Panel** — Users manage their own listings at `/partner/{id}` (tenant isolation)
- 🌍 **10 Languages** — English, Turkish, Arabic, German, French, Spanish, Portuguese, Russian, Chinese, Japanese
- 🐳 **Docker Ready** — One-command production and development setup
- ☁️ **GitHub Codespaces** — Zero-config cloud development

## AI Custom Instructions

Project-level custom instruction set files are available at:

- `.chatgpt/CUSTOM_INSTRUCTIONS.md` (ChatGPT)
- `.codex/CUSTOM_INSTRUCTIONS.md` (Codex)
- `.gemini/CUSTOM_INSTRUCTIONS.md` (Google Gemini / Antigravity)

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 12 |
| Admin UI | FilamentPHP v5 |
| Modules | nWidart/laravel-modules v11 |
| Auth/Roles | Spatie Laravel Permission |
| Frontend | Blade + TailwindCSS + Vite |
| Database | MySQL / SQLite |
| Cache/Queue | Redis |

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

### Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@openclassify.com | password |
| Partner | partner@openclassify.com | password |

**Admin Panel:** http://localhost:8000/admin
**Partner Panel:** http://localhost:8000/partner

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

**Requirements:** PHP 8.2+, Composer, Node 18+, SQLite or MySQL

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

---

## Architecture

### Module Structure

```
Modules/
├── Admin/              # FilamentPHP Admin Panel
│   ├── Filament/
│   │   └── Resources/  # CRUD resources (User, Category, Listing, Location)
│   └── Providers/
│       ├── AdminServiceProvider.php
│       └── AdminPanelProvider.php
│
├── Partner/            # FilamentPHP Tenant Panel
│   ├── Filament/
│   │   └── Resources/  # Tenant-scoped Listing resource
│   └── Providers/
│       ├── PartnerServiceProvider.php
│       └── PartnerPanelProvider.php
│
├── Category/           # Category management
│   ├── Models/Category.php
│   ├── Http/Controllers/
│   ├── database/migrations/
│   └── database/seeders/
│
├── Listing/            # Listing management
│   ├── Models/Listing.php
│   ├── Http/Controllers/
│   ├── database/migrations/
│   └── database/seeders/
│
├── Location/           # Countries & Cities
│   ├── Models/{Country,City,District}.php
│   ├── database/migrations/
│   └── database/seeders/
│
└── Profile/            # User profile pages
    ├── Models/Profile.php
    ├── Http/Controllers/
    └── database/migrations/
```

### Panels

| Panel | URL | Access |
|-------|-----|--------|
| Admin | `/admin` | Users with `admin` role |
| Partner | `/partner/{id}` | All authenticated users (tenant-scoped) |

### Roles (Spatie Permission)

| Role | Access |
|------|--------|
| `admin` | Full admin panel access |
| `partner` | Partner panel only (manages own listings) |

---

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

---

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add your feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## License

MIT License. See [LICENSE](LICENSE) for details.
