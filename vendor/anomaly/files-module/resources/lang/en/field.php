<?php

return [
    'name'          => [
        'name'         => 'Name',
        'instructions' => [
            'disks'   => 'Specify a short descriptive name for the disk.',
            'folders' => 'Specify a short descriptive name for the folder.',
            'files'   => 'Specify the name of this file.',
        ],
    ],
    'title'         => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive title for this file.',
    ],
    'slug'          => [
        'name'         => 'Slug',
        'instructions' => 'The slug is used in building the storage location.',
    ],
    'size'          => [
        'name' => 'Size',
    ],
    'disk'          => [
        'name'         => 'Disk',
        'instructions' => 'Choose which disk this folder uses.',
    ],
    'folder'        => [
        'name' => 'Folder',
    ],
    'adapter'       => [
        'name' => 'Adapter',
    ],
    'keywords'      => [
        'name'         => 'Keywords',
        'instructions' => 'Specify any organizational keywords to help group files.',
    ],
    'mime_type'     => [
        'name' => 'MIME Type',
    ],
    'preview'       => [
        'name' => 'Preview',
    ],
    'description'   => [
        'name'         => 'Description',
        'instructions' => [
            'disks'  => 'Briefly describe this disk.',
            'folder' => 'Briefly describe this folder.',
            'files'  => 'Briefly describe this file.',
        ],
    ],
    'allowed_types' => [
        'name'         => 'Allowed Types',
        'instructions' => 'Specify the file type extensions that are allowed in this folder.',
        'warning'      => 'Note subtle differences between mime types like jpg and jpeg.',
        'placeholder'  => 'pdf, psd, jpg, jpeg',
    ],
    'alt_text'      => [
        'name'         => 'Alt Text',
        'instructions' => 'Specify the text alternative for an image.',
        'warning'      => 'The humanized filename is usually used as a fallback.',
    ],
    'caption'       => [
        'name'         => 'Caption',
        'instructions' => 'Specify accompanying text for an image.',
    ],
];
