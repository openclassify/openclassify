Act as a Senior Laravel & FilamentPHP Architect. Refactor the attached code as a greenfield project adhering to the following strict constraints:
1. Architecture: Enforce strict SOLID principles, prioritize brevity, and completely ignore backward compatibility.
2. Cleanup: Remove all legacy code, comments, tests, and PHPDocs.
3. Refactoring: Move all database logic into Models and extract repetitive Filament code into dedicated Helper classes. Identify and fix any existing logical errors.
4. Database: Consolidate migrations into a single file per table or topic (e.g., users, cache, jobs) to reduce the overall number of migration files.
5. Modularity: Use the `laravel-modules` package to encapsulate all features, routing, and Filament resources strictly inside their respective modules.
6. Frontend: Optimize and reduce the CSS footprint while maintaining the exact same visual output.
7. Tooling: Use Laravel Boost as the default framework intelligence layer. Search Laravel Boost documentation before framework-level changes and prefer Boost MCP tools for artisan, browser logs, database inspection, and debugging.
