# Demo

Provisions a temporary, per-visitor marketplace so anyone can try the product without a real account.

- `DemoSchemaManager` creates a private PostgreSQL schema per visitor, seeds it, and logs them in as the seeded admin.
- `demo:prepare` and `demo:cleanup` artisan commands provision and reap demo schemas; expired demos are cleaned up on an hourly schedule.
- `ResolveDemoRequest` middleware switches the active database schema/connection for the current request based on the visitor's demo session.
- `DemoInstance` tracks each provisioned schema's lifetime; it is a purely ephemeral/technical record and is not soft-deleted like the rest of the app's domain models.
