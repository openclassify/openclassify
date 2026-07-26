# Architecture & Data
* **Modular Monolith:** Strict boundaries; zero cross-module JOINs.
* **Design:** SOLID, KISS, MVC. Clean Apple style: minimalist, text-minimal, no animations.
* **Database:** PostgreSQL with SoftDeletes everywhere.
* **Logic:** Fat Models handle all DB interactions.
* **Shared Code:** Keep global helpers in the Laravel root.

# Code Standards
* **Types:** `declare(strict_types=1);` in every file.
* **Language:** : English codebase. Translate each module inside of. 
* **Comments:** Zero. Code must be entirely self-documenting.
