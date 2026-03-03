<?php

return [
    /*
    |--------------------------------------------------------------------------
    | File Manager Mode
    |--------------------------------------------------------------------------
    |
    | The file manager supports two modes:
    |
    | - 'database': Files and folders are tracked in a database table.
    |   Metadata, hierarchy, and relationships are stored in the database.
    |   File contents are stored on the configured disk. Best for applications
    |   that need to attach metadata, tags, or relationships to files.
    |
    | - 'storage': Files and folders are read directly from a storage disk.
    |   No database is used. The file manager shows the actual file system
    |   structure. Renaming and moving actually rename/move files on the disk.
    |   Best for managing cloud storage (S3, etc.) or local file systems.
    |
    */
    'mode' => 'database', // 'database' or 'storage'

    /*
    |--------------------------------------------------------------------------
    | Storage Mode Settings
    |--------------------------------------------------------------------------
    |
    | These settings only apply when mode is set to 'storage'.
    |
    | - disk: The Laravel filesystem disk to use (e.g., 'local', 's3', 'public')
    | - root: The root path within the disk (empty string for disk root)
    | - show_hidden: Whether to show hidden files (starting with .)
    |
    */
    'storage_mode' => [
        'disk' => env('FILEMANAGER_DISK', env('FILESYSTEM_DISK', 'public')),
        'root' => env('FILEMANAGER_ROOT', ''),
        'show_hidden' => env('FILEMANAGER_SHOW_HIDDEN', false),
        // For S3/MinIO: URL expiration time in minutes for signed URLs
        'url_expiration' => env('FILEMANAGER_URL_EXPIRATION', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | File Streaming Settings
    |--------------------------------------------------------------------------
    |
    | Configure how files are served for preview and download.
    |
    | The file manager uses different URL strategies based on the disk:
    | - S3-compatible disks: Uses temporaryUrl() for pre-signed URLs
    | - Public disk: Uses direct Storage::url() (works via symlink)
    | - Local/other disks: Uses signed routes to a streaming controller
    |
    */
    'streaming' => [
        // URL generation strategy:
        // - 'auto': Automatically detect best strategy per disk (recommended)
        // - 'signed_route': Always use signed routes to streaming controller
        // - 'direct': Always use Storage::url() (only works for public disk)
        'url_strategy' => env('FILEMANAGER_URL_STRATEGY', 'auto'),

        // URL expiration in minutes (for signed URLs and S3 temporary URLs)
        'url_expiration' => env('FILEMANAGER_URL_EXPIRATION', 60),

        // Route prefix for streaming endpoints
        'route_prefix' => env('FILEMANAGER_ROUTE_PREFIX', 'filemanager'),

        // Middleware applied to streaming routes
        'middleware' => ['web'],

        // Disks that should always use signed routes (even if public)
        // Useful if you want extra security for certain disks
        'force_signed_disks' => [],

        // Disks that are publicly accessible via URL (override auto-detection)
        // Files on these disks can be accessed directly without streaming
        'public_disks' => ['public'],

        // Disks that don't require authentication for streaming access
        // Use with caution - files on these disks can be accessed without login
        // Note: Signed URLs are still required, this just skips the auth check
        'public_access_disks' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | File System Item Model (Database Mode)
    |--------------------------------------------------------------------------
    |
    | This is the model that represents files and folders in your application.
    | Only used when mode is 'database'.
    | It must implement the MWGuerra\FileManager\Contracts\FileSystemItemInterface.
    |
    | The package provides a default model. You can extend it or create your own:
    |
    | Option 1: Use the package model directly (default)
    | 'model' => \MWGuerra\FileManager\Models\FileSystemItem::class,
    |
    | Option 2: Extend the package model in your app
    | 'model' => \App\Models\FileSystemItem::class,
    | // where App\Models\FileSystemItem extends MWGuerra\FileManager\Models\FileSystemItem
    |
    | Option 3: Create your own model implementing FileSystemItemInterface
    | 'model' => \App\Models\CustomFileModel::class,
    |
    */
    'model' => \MWGuerra\FileManager\Models\FileSystemItem::class,

    /*
    |--------------------------------------------------------------------------
    | File Manager Page (Database Mode)
    |--------------------------------------------------------------------------
    |
    | Configure the File Manager page which uses database mode to track
    | files with metadata, hierarchy, and relationships.
    |
    */
    'file_manager' => [
        'enabled' => true,
        'navigation' => [
            'icon' => 'heroicon-o-folder',
            'label' => 'File Manager',
            'sort' => 1,
            'group' => 'FileManager',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File System Page (Storage Mode)
    |--------------------------------------------------------------------------
    |
    | Configure the File System page which shows files directly from the
    | storage disk without using the database.
    |
    */
    'file_system' => [
        'enabled' => true,
        'navigation' => [
            'icon' => 'heroicon-o-server-stack',
            'label' => 'File System',
            'sort' => 2,
            'group' => 'FileManager',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Schema Example Page
    |--------------------------------------------------------------------------
    |
    | Enable or disable the Schema Example page which demonstrates
    | how to embed the file manager components into Filament forms.
    |
    */
    'schema_example' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload Settings
    |--------------------------------------------------------------------------
    |
    | Configure upload settings for the file manager.
    |
    | Note: You may also need to adjust PHP settings in php.ini:
    |   - upload_max_filesize (default: 2M)
    |   - post_max_size (default: 8M)
    |   - max_execution_time (default: 30)
    |
    | For Livewire temporary uploads, also check config/livewire.php:
    |   - temporary_file_upload.rules (default: max:12288 = 12MB)
    |
    */
    'upload' => [
        'disk' => env('FILEMANAGER_DISK', env('FILESYSTEM_DISK', 'public')),
        'directory' => env('FILEMANAGER_UPLOAD_DIR', 'uploads'),
        'max_file_size' => 100 * 1024, // 100 MB in kilobytes
        'allowed_mimes' => [
            // Videos
            'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime', 'video/x-msvideo',
            // Images (SVG excluded by default - can contain scripts)
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            // Documents
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
            // Audio
            'audio/mpeg', 'audio/wav', 'audio/ogg', 'audio/webm', 'audio/flac',
            // Archives
            'application/zip', 'application/x-rar-compressed', 'application/x-7z-compressed',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Configure security settings to prevent malicious file uploads and access.
    |
    */
    'security' => [
        // Dangerous extensions that should NEVER be uploaded (executable files)
        'blocked_extensions' => [
            // Server-side scripts
            'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar',
            'pl', 'py', 'pyc', 'pyo', 'rb', 'sh', 'bash', 'zsh', 'cgi',
            'asp', 'aspx', 'jsp', 'jspx', 'cfm', 'cfc',
            // Executables
            'exe', 'msi', 'dll', 'com', 'bat', 'cmd', 'vbs', 'vbe',
            'js', 'jse', 'ws', 'wsf', 'wsc', 'wsh', 'ps1', 'psm1',
            // Other dangerous
            'htaccess', 'htpasswd', 'ini', 'log', 'sql', 'env',
            'pem', 'key', 'crt', 'cer',
        ],

        // Files that can contain embedded scripts (XSS risk when served inline)
        'sanitize_extensions' => ['svg', 'html', 'htm', 'xml'],

        // Validate MIME type matches extension (prevents spoofing)
        'validate_mime' => true,

        // Rename files to prevent execution (adds random prefix)
        'rename_uploads' => false,

        // Strip potentially dangerous characters from filenames
        'sanitize_filenames' => true,

        // Maximum filename length
        'max_filename_length' => 255,

        // Patterns blocked in filenames (regex)
        'blocked_filename_patterns' => [
            '/\.{2,}/',           // Multiple dots (path traversal)
            '/^\./',              // Hidden files
            '/[\x00-\x1f]/',      // Control characters
            '/[<>:"|?*]/',        // Windows reserved characters
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Authorization Settings
    |--------------------------------------------------------------------------
    |
    | Configure authorization for file manager operations.
    |
    | When enabled, the package will check permissions before allowing operations.
    | You can specify permission names that will be checked via the user's can() method.
    |
    | To customize authorization logic, extend FileSystemItemPolicy and register
    | your custom policy in your application's AuthServiceProvider.
    |
    */
    'authorization' => [
        // Enable/disable authorization checks (set to false during development)
        'enabled' => env('FILEMANAGER_AUTH_ENABLED', true),

        // Permission names to check (uses user->can() method)
        // Set to null to skip permission check and just require authentication
        'permissions' => [
            'view_any' => null,    // Access file manager page
            'view' => null,        // View/preview files
            'create' => null,      // Upload files, create folders
            'update' => null,      // Rename, move items
            'delete' => null,      // Delete items
            'delete_any' => null,  // Bulk delete
            'download' => null,    // Download files
        ],

        // The policy class to use (can be overridden with custom implementation)
        'policy' => \MWGuerra\FileManager\Policies\FileSystemItemPolicy::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Panel Sidebar Settings
    |--------------------------------------------------------------------------
    |
    | Configure the file manager folder tree that can be rendered in the
    | Filament panel sidebar using render hooks.
    |
    | - enabled: Enable/disable the sidebar folder tree
    | - root_label: Label for the root folder (e.g., "Root", "/", "Home")
    | - heading: Heading text shown above the folder tree
    | - show_in_file_manager: Show the sidebar within the file manager page
    |
    */
    'sidebar' => [
        'enabled' => true,
        'root_label' => env('FILEMANAGER_SIDEBAR_ROOT_LABEL', 'Root'),
        'heading' => env('FILEMANAGER_SIDEBAR_HEADING', 'Folders'),
        'show_in_file_manager' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | File Types
    |--------------------------------------------------------------------------
    |
    | Configure which file types are enabled and register custom file types.
    |
    | Built-in types can be disabled by setting their value to false.
    | Custom types can be added by listing their fully-qualified class names.
    |
    | Each custom type class must implement FileTypeContract or extend
    | AbstractFileType from MWGuerra\FileManager\FileTypes.
    |
    | Example of registering custom types:
    |
    | 'custom' => [
    |     \App\FileTypes\ThreeDModelFileType::class,
    |     \App\FileTypes\EbookFileType::class,
    | ],
    |
    */
    'file_types' => [
        // Built-in types (set to false to disable)
        'video' => true,
        'image' => true,
        'audio' => true,
        'pdf' => true,
        'text' => true,
        'document' => true,
        'archive' => true,

        // Custom file types (fully-qualified class names)
        'custom' => [
            // \App\FileTypes\ThreeDModelFileType::class,
        ],
    ],
];
