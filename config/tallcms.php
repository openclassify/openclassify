<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TallCMS Version
    |--------------------------------------------------------------------------
    |
    | The current version of TallCMS. Read dynamically from composer.json
    | to ensure it's always in sync with the installed package version.
    |
    */
    'version' => (function () {
        $composerJson = dirname(__DIR__).'/composer.json';
        if (file_exists($composerJson)) {
            $data = json_decode(file_get_contents($composerJson), true);

            return $data['version'] ?? 'unknown';
        }

        return 'unknown';
    })(),

    /*
    |--------------------------------------------------------------------------
    | Operation Mode
    |--------------------------------------------------------------------------
    |
    | Determines how TallCMS operates. Auto-detection works in most cases:
    | - 'standalone': Full TallCMS installation (tallcms/tallcms skeleton)
    | - 'plugin': Installed as a plugin in existing Filament app
    | - null: Auto-detect based on .tallcms-standalone marker file
    |
    */
    'mode' => env('TALLCMS_MODE'),

    /*
    |--------------------------------------------------------------------------
    | Database Configuration
    |--------------------------------------------------------------------------
    |
    | Table prefix for all TallCMS tables. Default 'tallcms_' maintains
    | compatibility with v1.x installations. Can be customized in plugin
    | mode to avoid conflicts with existing tables.
    |
    */
    'database' => [
        'prefix' => env('TALLCMS_TABLE_PREFIX', 'tallcms_'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin Mode Settings
    |--------------------------------------------------------------------------
    |
    | Configuration specific to plugin mode operation. These settings are
    | ignored in standalone mode.
    |
    */
    'plugin_mode' => [
        // Enable frontend CMS page routes.
        // When enabled, TallCMS registers both / (homepage) and /{slug} routes.
        // WARNING: Without a prefix, this will override your app's homepage route!
        'routes_enabled' => env('TALLCMS_ROUTES_ENABLED', false),

        // Optional URL prefix for CMS routes (e.g., 'cms' results in /cms and /cms/{slug})
        // Leave empty for root-level routes (/, /about, /contact)
        // When empty, smart exclusions prevent conflicts with your app routes.
        'routes_prefix' => env('TALLCMS_ROUTES_PREFIX', ''),

        // Route name prefix for plugin mode (e.g., 'tallcms.' results in tallcms.cms.page)
        'route_name_prefix' => env('TALLCMS_PLUGIN_ROUTE_NAME_PREFIX', 'tallcms.'),

        // Route exclusion pattern - paths matching this regex are excluded from CMS routing.
        // Default excludes common Laravel/Filament paths. Panel path is auto-excluded.
        //
        // In NON-i18n mode with standard format (^(?!foo|bar).*$): Merged with base exclusions.
        // In NON-i18n mode with custom regex: Used as-is, replaces default pattern entirely.
        //   NOTE: When using custom regex, 'additional_exclusions' is ignored.
        // In i18n mode: Only standard negative lookahead format is merged; other formats ignored.
        'route_exclusions' => env('TALLCMS_PLUGIN_ROUTE_EXCLUSIONS',
            env('TALLCMS_ROUTE_EXCLUSIONS', // backward compat
                '^(?!admin|app|api|livewire|sanctum|storage|build|vendor|health|_).*$'
            )
        ),

        // Additional route exclusions as pipe-separated list (e.g., 'dashboard|settings|profile').
        // Merged with base exclusions when using standard route_exclusions format.
        // NOTE: Ignored when route_exclusions is set to a non-standard custom regex.
        // Recommended for i18n mode where custom regex is not supported.
        'additional_exclusions' => env('TALLCMS_ADDITIONAL_EXCLUSIONS', ''),

        // Enable preview routes (/preview/page/{id}, /preview/post/{id})
        'preview_routes_enabled' => env('TALLCMS_PREVIEW_ROUTES_ENABLED', true),

        // Enable API routes (/api/contact)
        'api_routes_enabled' => env('TALLCMS_API_ROUTES_ENABLED', true),

        // Optional prefix for essential routes (preview, contact API) to avoid conflicts
        // e.g., 'tallcms' results in /tallcms/preview/page/{id}
        'essential_routes_prefix' => env('TALLCMS_ESSENTIAL_ROUTES_PREFIX', ''),

        // Enable core SEO routes (sitemap.xml, robots.txt).
        // These are always registered at root level (no prefix) since search
        // engines expect them at standard locations. Safe to enable.
        'seo_routes_enabled' => env('TALLCMS_SEO_ROUTES_ENABLED', true),

        // Enable archive routes (RSS feed, category archives, author archives).
        // These routes (/feed, /category/{slug}, /author/{slug}) may conflict
        // with your app's routes. Disabled by default in plugin mode.
        'archive_routes_enabled' => env('TALLCMS_ARCHIVE_ROUTES_ENABLED', false),

        // Optional prefix for archive routes to avoid conflicts.
        // e.g., 'blog' results in /blog/feed, /blog/category/{slug}, /blog/author/{slug}
        'archive_routes_prefix' => env('TALLCMS_ARCHIVE_ROUTES_PREFIX', ''),

        // Enable the TallCMS plugin system.
        // When enabled, the Plugin Manager page is visible and third-party plugins can be loaded.
        'plugins_enabled' => env('TALLCMS_PLUGINS_ENABLED', true),

        // Enable the TallCMS theme system.
        // When enabled, the Theme Manager page is visible and themes can be loaded.
        'themes_enabled' => env('TALLCMS_THEMES_ENABLED', true),

        // User model class. Must implement TallCmsUserContract.
        // Default works with standard Laravel User model with HasRoles trait.
        'user_model' => env('TALLCMS_USER_MODEL', 'App\\Models\\User'),

        // Skip installer.lock check for maintenance mode in plugin mode.
        // In plugin mode, the host app doesn't use TallCMS's installer,
        // so we assume the app is properly installed. Default: true
        'skip_installer_check' => env('TALLCMS_SKIP_INSTALLER_CHECK', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for authentication guards used by TallCMS roles and
    | permissions. This should match your Filament panel's guard.
    |
    */
    'auth' => [
        // Guard name for roles and permissions (should match Filament panel guard)
        'guard' => env('TALLCMS_AUTH_GUARD', 'web'),

        // Login route for preview authentication redirect
        // Can be a route name (e.g., 'filament.admin.auth.login') or URL
        // Leave null to auto-detect Filament's login route
        'login_route' => env('TALLCMS_LOGIN_ROUTE'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Filament Panel Configuration
    |--------------------------------------------------------------------------
    |
    | These settings are dynamically set by TallCmsPlugin when registered.
    | They allow customization of navigation group and sort order.
    |
    */
    'filament' => [
        // Panel ID for route generation in notifications
        // Used for constructing admin panel URLs like filament.{panel_id}.resources.*
        'panel_id' => env('TALLCMS_PANEL_ID', 'admin'),

        // Panel path for URL construction and middleware exclusions
        'panel_path' => env('TALLCMS_PANEL_PATH', 'admin'),

        // Navigation group override - when set, CMS resources/pages use this group.
        // Note: UserResource stays in 'User Management' regardless of this setting.
        // Leave unset (null) to use per-resource defaults (Content Management, Settings, etc.)
        'navigation_group' => env('TALLCMS_NAVIGATION_GROUP'),

        // Navigation sort override - when set, CMS resources/pages use this sort.
        // Leave unset (null) to use per-resource defaults.
        'navigation_sort' => env('TALLCMS_NAVIGATION_SORT') !== null
            ? (int) env('TALLCMS_NAVIGATION_SORT')
            : null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | Default contact information used in templates and merge tags.
    |
    */
    'contact_email' => env('TALLCMS_CONTACT_EMAIL'),
    'company_name' => env('TALLCMS_COMPANY_NAME'),
    'company_address' => env('TALLCMS_COMPANY_ADDRESS'),

    /*
    |--------------------------------------------------------------------------
    | Publishing Workflow
    |--------------------------------------------------------------------------
    |
    | Configuration for the content publishing workflow including
    | revision history and preview tokens.
    |
    */
    'publishing' => [
        // Maximum number of automatic revisions to keep per content item.
        // Set to null for unlimited. Default: 100
        'revision_limit' => env('CMS_REVISION_LIMIT', 100),

        // Maximum number of manual (pinned) snapshots to keep per content item.
        // Set to null for unlimited. Default: 50
        'revision_manual_limit' => env('CMS_REVISION_MANUAL_LIMIT', 50),

        // Notification channels for workflow events
        // Available: 'mail', 'database'
        'notification_channels' => explode(',', env('CMS_NOTIFICATION_CHANNELS', 'mail,database')),

        // Default preview token expiry in hours
        'default_preview_expiry_hours' => 24,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugin System
    |--------------------------------------------------------------------------
    |
    | Configuration for the TallCMS plugin system including license management.
    | The Plugin Manager UI is always available, but local plugin loading
    | requires explicit opt-in via plugin_mode.plugins_enabled.
    |
    */
    'plugins' => [
        // Path where plugins are stored
        'path' => env('TALLCMS_PLUGINS_PATH', base_path('plugins')),

        // Allow ZIP-based plugin uploads through admin UI
        'allow_uploads' => env('TALLCMS_PLUGIN_ALLOW_UPLOADS', env('PLUGIN_ALLOW_UPLOADS', true)),

        // Maximum upload size for plugin ZIP files (bytes). Default: 50MB
        'max_upload_size' => env('TALLCMS_PLUGIN_MAX_UPLOAD_SIZE', env('PLUGIN_MAX_UPLOAD_SIZE', 50 * 1024 * 1024)),

        // Plugin discovery caching
        'cache_enabled' => env('TALLCMS_PLUGIN_CACHE_ENABLED', env('PLUGIN_CACHE_ENABLED', true)),
        'cache_ttl' => 3600, // 1 hour

        // Automatically run plugin migrations on install
        'auto_migrate' => env('TALLCMS_PLUGIN_AUTO_MIGRATE', env('PLUGIN_AUTO_MIGRATE', true)),

        // License management settings
        'license' => [
            // License proxy URL for official TallCMS plugins
            'proxy_url' => env('TALLCMS_LICENSE_PROXY_URL', 'https://tallcms.com'),

            // Cache TTL for license validation results (seconds). Default: 6 hours
            'cache_ttl' => 21600,

            // Grace period when license server unreachable (days). Default: 7
            'offline_grace_days' => 7,

            // Grace period after license expiration (days). Default: 14
            'renewal_grace_days' => 14,

            // How often to check for updates (seconds). Default: 24 hours
            'update_check_interval' => 86400,

            // Purchase URLs for plugins (shown when no license is active)
            'purchase_urls' => [
                'tallcms/pro' => 'https://checkout.anystack.sh/tallcms-pro-plugin',
                'tallcms/mega-menu' => 'https://checkout.anystack.sh/tallcms-mega-menu-plugin',
            ],

            // Download URLs for plugins (shown when license is valid)
            'download_urls' => [
                'tallcms/pro' => 'https://anystack.sh/download/tallcms-pro-plugin',
                'tallcms/mega-menu' => 'https://anystack.sh/download/tallcms-mega-menu-plugin',
            ],
        ],

        // Official plugin catalog (shown in Plugin Manager)
        'catalog' => [
            'tallcms/pro' => [
                'name' => 'TallCMS Pro',
                'slug' => 'pro',
                'vendor' => 'tallcms',
                'description' => 'Advanced blocks, analytics, and integrations for TallCMS.',
                'author' => 'TallCMS',
                'homepage' => 'https://tallcms.com/pro',
                'icon' => 'heroicon-o-sparkles',
                'category' => 'official',
                'featured' => true,
                'download_url' => 'https://anystack.sh/download/tallcms-pro-plugin',
                'purchase_url' => 'https://checkout.anystack.sh/tallcms-pro-plugin',
            ],
            'tallcms/mega-menu' => [
                'name' => 'TallCMS Mega Menu',
                'slug' => 'mega-menu',
                'vendor' => 'tallcms',
                'description' => 'Create stunning mega menus for your website with ease. Build rich, multi-column dropdown menus with images, icons, and custom layouts.',
                'author' => 'TallCMS',
                'homepage' => 'https://tallcms.com/mega-menu',
                'icon' => 'heroicon-o-bars-3-bottom-left',
                'category' => 'official',
                'featured' => true,
                'download_url' => 'https://anystack.sh/download/tallcms-mega-menu-plugin',
                'purchase_url' => 'https://checkout.anystack.sh/tallcms-mega-menu-plugin',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme System
    |--------------------------------------------------------------------------
    |
    | Configuration for the TallCMS theme system. The Theme Manager UI is
    | always available, but theme loading requires explicit opt-in via
    | plugin_mode.themes_enabled in plugin mode.
    |
    */
    'themes' => [
        // Path where themes are stored
        'path' => env('TALLCMS_THEMES_PATH', base_path('themes')),

        // Allow ZIP-based theme uploads through admin UI
        'allow_uploads' => env('TALLCMS_THEME_ALLOW_UPLOADS', true),

        // Maximum upload size for theme ZIP files (bytes). Default: 100MB
        'max_upload_size' => env('TALLCMS_THEME_MAX_UPLOAD_SIZE', 100 * 1024 * 1024),

        // Theme discovery caching
        'cache_enabled' => env('TALLCMS_THEME_CACHE_ENABLED', false),
        'cache_ttl' => 3600, // 1 hour

        // Preview session duration (minutes)
        'preview_duration' => 30,

        // Rollback availability window (hours)
        'rollback_duration' => 24,
    ],

    /*
    |--------------------------------------------------------------------------
    | REST API
    |--------------------------------------------------------------------------
    |
    | Configuration for the TallCMS REST API. The API provides full CRUD
    | operations for Pages, Posts, Categories, and Media with authentication
    | via Laravel Sanctum tokens.
    |
    */
    'api' => [
        // Enable or disable the REST API
        'enabled' => env('TALLCMS_API_ENABLED', false),

        // API route prefix (e.g., 'api/v1/tallcms' results in /api/v1/tallcms/pages)
        'prefix' => env('TALLCMS_API_PREFIX', 'api/v1/tallcms'),

        // Standard rate limit (requests per minute)
        'rate_limit' => env('TALLCMS_API_RATE_LIMIT', 60),

        // Authentication rate limit (failed attempts before lockout)
        'auth_rate_limit' => env('TALLCMS_API_AUTH_RATE_LIMIT', 5),

        // Authentication lockout duration (minutes)
        'auth_lockout_minutes' => env('TALLCMS_API_AUTH_LOCKOUT', 15),

        // Default token expiry (days)
        'token_expiry_days' => env('TALLCMS_API_TOKEN_EXPIRY', 365),

        // Maximum items per page for pagination
        'max_per_page' => 100,
    ],

    /*
    |--------------------------------------------------------------------------
    | Webhooks
    |--------------------------------------------------------------------------
    |
    | Configuration for webhook delivery to external services. Webhooks notify
    | external systems when content is created, updated, published, or deleted.
    |
    */
    'webhooks' => [
        // Enable or disable webhooks
        'enabled' => env('TALLCMS_WEBHOOKS_ENABLED', false),

        // Request timeout (seconds)
        'timeout' => env('TALLCMS_WEBHOOK_TIMEOUT', 30),

        // Maximum retry attempts
        'max_retries' => env('TALLCMS_WEBHOOK_MAX_RETRIES', 3),

        // Delay before retry attempts (seconds) - retry 1, 2, 3
        'retry_backoff' => [60, 300, 900],

        // Maximum response body size to store (bytes)
        'response_max_size' => 10000,

        // Allowed hosts (empty = allow all public IPs)
        'allowed_hosts' => [],

        // Explicitly blocked hosts
        'blocked_hosts' => [],

        // Queue name for webhook jobs
        'queue' => env('TALLCMS_WEBHOOK_QUEUE', 'default'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Internationalization (i18n)
    |--------------------------------------------------------------------------
    |
    | Core i18n configuration. Locales are merged from multiple sources:
    | - Config: Base locales (always available)
    | - Plugins: Can ADD new locale codes (cannot override config)
    | - DB: Can MODIFY existing locales (enable/disable/rename, cannot add)
    |
    */
    'i18n' => [
        // Master switch for multilingual features
        'enabled' => env('TALLCMS_I18N_ENABLED', false),

        // Base locales (always available, plugins can add new ones, DB can modify existing)
        'locales' => [
            'en' => [
                'label' => 'English',
                'native' => 'English',
                'rtl' => false,
            ],
            'zh_CN' => [
                'label' => 'Chinese (Simplified)',
                'native' => '简体中文',
                'rtl' => false,
            ],
        ],

        // Default/fallback locale (must exist in registry)
        'default_locale' => env('TALLCMS_DEFAULT_LOCALE', 'en'),

        // URL strategy: 'prefix' (/en/about) or 'none' (query param fallback)
        'url_strategy' => 'prefix',

        // Hide default locale from URL (/ instead of /en/)
        'hide_default_locale' => env('TALLCMS_HIDE_DEFAULT_LOCALE', true),

        // Fallback when translation missing: 'default', 'empty', 'key'
        'fallback_behavior' => 'default',

        // Remember locale preference in session
        'remember_locale' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    |
    | Configuration for the blog post commenting system. Comments require
    | admin approval before appearing publicly.
    |
    */
    'comments' => [
        'enabled' => env('TALLCMS_COMMENTS_ENABLED', true),
        'moderation' => env('TALLCMS_COMMENTS_MODERATION', 'manual'), // 'manual' = require approval, 'auto' = publish immediately
        'max_depth' => 2,                   // top-level + 1 reply level (min 1)
        'max_length' => 5000,               // max comment content length
        'rate_limit' => 5,                  // max comments per IP per window
        'rate_limit_decay' => 600,          // rate limit window in seconds
        'notification_channels' => ['mail', 'database'],
        'notify_on_approval' => true,       // email commenter when approved
        'guest_comments' => true,           // allow non-authenticated comments
    ],

    /*
    |--------------------------------------------------------------------------
    | Media Library
    |--------------------------------------------------------------------------
    |
    | Configuration for media library features including image optimization,
    | variant generation, and responsive image handling.
    |
    */
    'media' => [
        'optimization' => [
            // Enable or disable automatic image optimization
            'enabled' => env('TALLCMS_MEDIA_OPTIMIZATION', true),

            // Queue name for optimization jobs
            'queue' => env('TALLCMS_MEDIA_QUEUE', 'default'),

            // WebP quality (0-100)
            'quality' => env('TALLCMS_MEDIA_QUALITY', 80),

            // Variant presets - customize sizes as needed
            'variants' => [
                'thumbnail' => ['width' => 300, 'height' => 300, 'fit' => 'crop'],
                'medium' => ['width' => 800, 'height' => 600, 'fit' => 'contain'],
                'large' => ['width' => 1200, 'height' => 800, 'fit' => 'contain'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Full-Text Search
    |--------------------------------------------------------------------------
    |
    | Configuration for the full-text search functionality using Laravel Scout.
    | Requires SCOUT_DRIVER=database in your .env file.
    |
    */
    'search' => [
        // Enable or disable search functionality
        'enabled' => env('TALLCMS_SEARCH_ENABLED', true),

        // Minimum query length required before searching
        'min_query_length' => 2,

        // Number of results per page on the search results page
        'results_per_page' => 10,

        // Maximum results per model type to avoid memory issues
        'max_results_per_type' => 50,

        // Which content types to include in search
        'searchable_types' => ['pages', 'posts'],
    ],

    /*
    |--------------------------------------------------------------------------
    | System Updates (Standalone Mode Only)
    |--------------------------------------------------------------------------
    |
    | Configuration for the one-click update system. These settings are
    | IGNORED in plugin mode - use Composer for updates instead.
    |
    */
    'updates' => [
        // Enable or disable the update system (standalone mode only)
        'enabled' => env('TALLCMS_UPDATES_ENABLED', true),

        // How often to check for updates (seconds). Default: 24 hours
        'check_interval' => 86400,

        // Cache TTL for GitHub API responses (seconds). Default: 1 hour
        'cache_ttl' => 3600,

        // GitHub repository for updates
        'github_repo' => 'tallcms/tallcms',

        // Optional GitHub token for higher API rate limits
        'github_token' => env('TALLCMS_GITHUB_TOKEN'),

        // Number of backup sets to retain
        'backup_retention' => 3,

        // Automatically backup files before updating
        'auto_backup' => true,

        // Require database backup before update
        'require_db_backup' => true,

        // Maximum database size for automatic backup (bytes). Default: 100MB
        'db_backup_size_limit' => 100 * 1024 * 1024,

        // Ed25519 public key for release signature verification (hex-encoded)
        'public_key' => env('TALLCMS_UPDATE_PUBLIC_KEY', '6c41c964c60dd5341f7ba649dcda6e6de4b0b7afac2fbb9489527987907d35a9'),
    ],
];
