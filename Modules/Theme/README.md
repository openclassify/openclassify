# Theme

A small, pluggable view-resolution mechanism so a module's frontend can be swapped without touching its controllers.

- `ThemeManager::view($module, $name)` resolves `{module}::themes.{active}.{name}`, falling back to `{module}::themes.default.{name}` if the active theme doesn't provide that view.
- The active theme is read from `config('theme')` (published from `Modules/Theme/config/theme.php`), globally via `OC_THEME` or per module via `OC_THEME_{MODULE}` (e.g. `OC_THEME_LISTING`).
- Today only `default` is implemented (see `Modules/Listing/resources/views/themes/default` and `Modules/Category/resources/views/themes/default`); the mechanism exists so a new theme can be dropped in later without a code change.
