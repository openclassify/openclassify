# Listing Theme Contract

Active template is resolved from `config('theme.modules.listing')`.

Directory structure:

- `themes/{theme}/index.blade.php`
- `themes/{theme}/show.blade.php`

Fallback order:

1. `listing::themes.{active}.{view}`
2. `listing::themes.default.{view}`
3. `listing::{view}`

To add a new theme:

1. Create `Modules/Listing/resources/views/themes/{your-theme}/index.blade.php`.
2. Create `Modules/Listing/resources/views/themes/{your-theme}/show.blade.php`.
3. Set `OC_THEME_LISTING={your-theme}` in `.env`.
