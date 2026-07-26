# Category

The classifieds category taxonomy: a self-referencing tree (`parent_id`) with slug, icon, sort order and active flag.

- Public routes/controller render the category index and directory pages.
- `Category` model carries the tree-building and lookup logic (root/child queries, listing counts per category, header navigation items, admin hierarchy tree) so controllers and Filament resources stay thin.
- `Filament/Admin/Resources/CategoryResource` manages categories from the admin panel.

Other modules (Listing, Favorite) depend on `Category` for classification but never query its table directly — they go through the model's public API.
