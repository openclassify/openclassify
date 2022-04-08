<?php

return [
    'name'         => [
        'name'         => 'Name',
        'instructions' => 'What is the field name?',
    ],
    'slug'         => [
        'name'         => 'Slug',
        'instructions' => 'The slug, among other things, is used for the database column name.',
    ],
    'description'  => [
        'name'         => 'Description',
        'instructions' => 'Enter a brief description.',
    ],
    'type'         => [
        'name'         => 'Field Type',
        'instructions' => 'What field type do you want to use for this field?',
        'warning'      => 'Changing this value will result in an immediate page reload.',
    ],
    'placeholder'  => [
        'name'         => 'Placeholder',
        'instructions' => 'If supported, placeholders will display in the input when no input has been entered.',
    ],
    'title_column' => [
        'name'         => 'Title Column',
        'instructions' => 'Specify the field slug that acts as a title?',
    ],
    'instructions' => [
        'name'         => 'Instructions',
        'instructions' => 'Field instructions will be displayed in forms to assist users.',
    ],
    'warning'      => [
        'name'         => 'Warning',
        'instructions' => 'Warnings help bring attention to important information.',
    ],
    'translatable' => [
        'name'         => 'Translatable',
        'instructions' => 'Are the entries in this stream multilingual?',
        'warning'      => 'The stream must be translatable for translatable fields to work properly.',
    ],
    'trashable'    => [
        'name'         => 'Trashable',
        'instructions' => 'Do you want to trash entries instead of deleting them?',
    ],
    'versionable'  => [
        'name'         => 'Versionable',
        'instructions' => 'Do you want to track changes to entries each time they save?',
    ],
    'sortable'     => [
        'name'         => 'Sortable',
        'instructions' => 'Are the entries in this stream manually sortable?',
    ],
    'searchable'   => [
        'name'         => 'Searchable',
        'instructions' => 'Are the entries in this stream searchable?',
    ],
    'config'       => [
        'name'         => 'Configuration',
        'instructions' => 'Specify any optional configuration using JSON.',
    ],
];
