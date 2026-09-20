# Site

The public storefront's shell: the homepage, the shared page layout (nav, search, location picker, footer), language switching, and general site settings.

- `layouts/app.blade.php` is the layout every public page extends; `home.blade.php` is the marketplace homepage.
- `App/Settings` (via `spatie/laravel-settings`) backs the general settings screen (`Filament/Admin/Pages/ManageGeneralSettings`) — site name, description, social links, homepage slides.
- `App/Support/LocalMedia` centralizes how locally-stored media (settings images, listing fallback images) resolve to public URLs.
- Demo-mode landing behavior (the "Prepare Demo" screen unauthenticated visitors see) also lives here, reading state from the `Demo` module.
