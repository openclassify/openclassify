# User

Authentication and the user account itself.

- Standard email/password auth (login, register, password reset/confirm, email verification) plus Socialite-based social login, all under `App/Http/Controllers/Auth`.
- `User` is the app's fat auth model: roles/permissions (`spatie/laravel-permission`), Filament panel access, favorites, conversations, header badge counts, impersonation rules, and account state (`UserStatus`: active/suspended/banned) all live here.
- `Profile` holds the extended, optional profile fields (bio, phone, city, country, avatar) kept separate from the core `users` table.
- `Filament/Admin/Resources/UserResource` is the staff view for managing accounts and roles.
