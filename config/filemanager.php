<?php

declare(strict_types=1);

use MWGuerra\FileManager\Models\FileSystemItem;
use MWGuerra\FileManager\Policies\FileSystemItemPolicy;

return [
    'mode' => 'database',
    'storage_mode' => [
        'disk' => 'public',
        'root' => env('FILEMANAGER_ROOT', ''),
        'show_hidden' => env('FILEMANAGER_SHOW_HIDDEN', false),
        'url_expiration' => env('FILEMANAGER_URL_EXPIRATION', 60),
    ],
    'streaming' => [
        'url_strategy' => env('FILEMANAGER_URL_STRATEGY', 'auto'),
        'url_expiration' => env('FILEMANAGER_URL_EXPIRATION', 60),
        'route_prefix' => env('FILEMANAGER_ROUTE_PREFIX', 'filemanager'),
        'middleware' => ['web'],
        'force_signed_disks' => [],
        'public_disks' => ['public'],
        'public_access_disks' => [],
    ],
    'model' => FileSystemItem::class,
    'file_manager' => [
        'enabled' => true,
        'navigation' => [
            'icon' => 'heroicon-o-folder',
            'label' => 'File Manager',
            'sort' => 1,
            'group' => 'FileManager',
        ],
    ],
    'file_system' => [
        'enabled' => true,
        'navigation' => [
            'icon' => 'heroicon-o-server-stack',
            'label' => 'File System',
            'sort' => 2,
            'group' => 'FileManager',
        ],
    ],
    'schema_example' => [
        'enabled' => true,
    ],
    'upload' => [
        'disk' => 'public',
        'directory' => env('FILEMANAGER_UPLOAD_DIR', 'uploads'),
        'max_file_size' => 100 * 1024,
        'allowed_mimes' => [
            'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime', 'video/x-msvideo',
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
            'audio/mpeg', 'audio/wav', 'audio/ogg', 'audio/webm', 'audio/flac',
            'application/zip', 'application/x-rar-compressed', 'application/x-7z-compressed',
        ],
    ],
    'security' => [
        'blocked_extensions' => [
            'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar',
            'pl', 'py', 'pyc', 'pyo', 'rb', 'sh', 'bash', 'zsh', 'cgi',
            'asp', 'aspx', 'jsp', 'jspx', 'cfm', 'cfc',
            'exe', 'msi', 'dll', 'com', 'bat', 'cmd', 'vbs', 'vbe',
            'js', 'jse', 'ws', 'wsf', 'wsc', 'wsh', 'ps1', 'psm1',
            'htaccess', 'htpasswd', 'ini', 'log', 'sql', 'env',
            'pem', 'key', 'crt', 'cer',
        ],
        'sanitize_extensions' => ['svg', 'html', 'htm', 'xml'],
        'validate_mime' => true,
        'rename_uploads' => false,
        'sanitize_filenames' => true,
        'max_filename_length' => 255,
        'blocked_filename_patterns' => [
            '/\.{2,}/',
            '/^\./',
            '/[\x00-\x1f]/',
            '/[<>:"|?*]/',
        ],
    ],
    'authorization' => [
        'enabled' => env('FILEMANAGER_AUTH_ENABLED', true),
        'permissions' => [
            'view_any' => null,
            'view' => null,
            'create' => null,
            'update' => null,
            'delete' => null,
            'delete_any' => null,
            'download' => null,
        ],
        'policy' => FileSystemItemPolicy::class,
    ],
    'sidebar' => [
        'enabled' => true,
        'root_label' => env('FILEMANAGER_SIDEBAR_ROOT_LABEL', 'Root'),
        'heading' => env('FILEMANAGER_SIDEBAR_HEADING', 'Folders'),
        'show_in_file_manager' => true,
    ],
    'file_types' => [
        'video' => true,
        'image' => true,
        'audio' => true,
        'pdf' => true,
        'text' => true,
        'document' => true,
        'archive' => true,
        'custom' => [
        ],
    ],
];
