# Listing

The core classifieds entity: title, price, category, location, media, custom fields, and a status lifecycle (pending, active, sold, expired) modeled with `spatie/laravel-model-states`.

- `Listing` is a deliberately fat model: browse/search scopes, media handling (gallery/card/thumbnail conversions via Spatie MediaLibrary), status transitions, and every read model used by the public pages and the panel dashboard all live here rather than in controllers.
- Public browsing (`ListingController`) renders through the pluggable theme system (`Modules/Theme`) — see `resources/views/themes/default` for the active theme and `resources/views/themes/README.md` for how theming works.
- `ListingCustomField` defines the dynamic, per-category form fields shown when creating a listing.
- `Filament/Admin/Resources/ListingResource` is the staff admin view, including moderation and dashboard widgets.

Depends on `Category`, `Location`, `User`, `Video`, and `Conversation` only through their models' public relationships/APIs — never raw joins across module tables.
