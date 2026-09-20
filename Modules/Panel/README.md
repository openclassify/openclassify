# Panel

The authenticated user's self-service dashboard — everything a seller does after logging in: manage their own listings, upload/manage videos, edit their profile.

- Blade views + a single Livewire component (`PanelQuickListingForm`) drive the multi-step "quick create listing" wizard; all persistence is delegated to `Listing`, `Video`, and `Profile` model methods rather than queried inline.
- Routes are scoped under `panel/*` and require authentication.
- Visually this is the app's dashboard surface, distinct from the public storefront (`Site`/`Listing` themes) and from the staff Filament admin (`Admin`).
