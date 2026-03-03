# OpenClassify Changelog

All notable changes to OpenClassify will be documented in this file.

## [1.0.0] - 2025-01-01

### Added
- Initial release of OpenClassify — a Laravel 12 classified ads platform (inspired by Letgo/OLX)
- **Category Module**: Hierarchical categories with icons and up to 10 levels of nesting; seeded with 8 top-level categories and 33 subcategories
- **Listing Module**: Classified ads with title, description, price, currency, location, featured flag, and contact info
- **Location Module**: Country/City/District/Neighborhood hierarchy with seed data for 5 countries
- **Profile Module**: User profile management with bio, phone, location, and website
- Home page with hero search bar, stats bar, category grid, featured listings, and recent listings
- Partner dashboard showing user's own listings with activity stats
- Language switcher with support for 10 locales: English, Turkish, Arabic, Chinese, Spanish, French, German, Portuguese, Russian, Japanese
- RTL layout support for Arabic
- SQLite database with full migration support
- Authentication via Laravel Breeze (login, register, password reset, email verification)
- Responsive UI using Tailwind CSS
