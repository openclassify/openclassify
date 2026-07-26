# Admin

Bootstraps the staff Filament panel at `/admin`.

`AdminPanelProvider` registers the panel, its plugins (Breezy profile/2FA, impersonation, developer logins, file manager, activity log, state-fusion) and pulls in each domain module's Filament plugin (Category, Listing, Location, Site, User, Video) so their resources appear in the same panel without those modules depending on each other.

`Support/Filament/ResourceTableActions` and `ResourceTableColumns` are shared, stateless factories for common table columns and row actions, reused across every module's Filament resource to keep resource classes thin.

Also owns the `activity_log` table migration used by every model with the `LogsActivity` trait.
