# Favorite

Everything a buyer can save for later: favorited listings, favorited sellers, and saved searches.

- Favoriting a listing/seller is a simple pivot toggle, implemented on the `User` model (`toggleFavoriteListing`, `toggleFavoriteSeller`).
- `FavoriteSearch` is the one real entity this module owns: a named, de-duplicated (by signature) saved search with its filters serialized as JSON.
- The favorites index page lists saved listings, sellers, and searches for the current user.
