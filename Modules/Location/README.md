# Location

The geographic hierarchy used for listing locations and browse filters: `Country` → `City` → `District` → neighborhood.

- Each level model carries its own lookup/option-building helpers (`nameOptions`, `districtPayloads`, `resolveLookup`, etc.) used by both the public location picker and the panel's quick-create form.
- `LocationLookupController` exposes a small JSON endpoint for cascading country → city → district selects.
- `Filament/Admin/Resources` manage countries, cities, and districts from the admin panel.

Listing does not join against these tables directly; it stores denormalized `city`/`country` strings plus latitude/longitude, populated through this module's lookups at creation time.
