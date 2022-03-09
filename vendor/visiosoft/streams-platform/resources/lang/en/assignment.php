<?php

return [
    'field'        => [
        'name'         => 'Field',
        'label'        => 'Field',
        'instructions' => 'Choose the field to assign.',
    ],
    'label'        => [
        'name'         => 'Label',
        'instructions' => 'Label\'s will be used for forms only. If left blank, the field name will be used.',
    ],
    'required'     => [
        'name'         => 'Required',
        'label'        => 'Is this field required?',
        'instructions' => 'If required, this field MUST have a value at all times.',
    ],
    'unique'       => [
        'name'         => 'Unique',
        'label'        => 'Is this field unique?',
        'instructions' => 'If unique, this field MUST have a unique value.',
    ],
    'searchable'   => [
        'name'         => 'Searchable',
        'label'        => 'Is this field searchable?',
        'instructions' => 'Only searchable fields will be indexed.',
    ],
    'placeholder'  => [
        'name'         => 'Placeholder',
        'instructions' => 'If supported, placeholders will display in the input when no input has been entered.',
    ],
    'translatable' => [
        'name'         => 'Translatable',
        'label'        => 'Is this field translatable?',
        'instructions' => 'If translatable this field will be available in all enabled locales.',
        'warning'      => [
            'column_type' => 'The associated field type does not support translated values.',
            'stream'      => 'The associated stream is not translatable.',
        ],
    ],
    'instructions' => [
        'name'         => 'Instructions',
        'instructions' => 'Field instructions will be displayed in forms to assist users.',
    ],
    'warning'      => [
        'name'         => 'Warning',
        'instructions' => 'Warnings help bring attention to important information.',
    ],
];
