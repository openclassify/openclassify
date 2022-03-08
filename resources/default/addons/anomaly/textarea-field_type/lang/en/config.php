<?php

return [
    'rows'          => [
        'label'        => 'Input Rows',
        'instructions' => 'Specify the visible number of lines in the text area before scrolling.',
    ],
    'min'           => [
        'label'        => 'Minimum Length',
        'instructions' => 'Specify the minimum input length allowed.',
    ],
    'max'           => [
        'label'        => 'Maximum Length',
        'instructions' => 'Specify the maximum input length allowed.',
    ],
    'autogrow'      => [
        'label'        => 'Autogrow',
        'instructions' => 'Automatically adjust input height while typing?',
        'warning'      => 'Height will not shrink past the <strong>Input Rows</strong> specified above.',
    ],
    'show_counter'  => [
        'label'        => 'Show Counter',
        'instructions' => 'Display the remaining characters while typing?',
    ],
    'default_value' => [
        'label'        => 'Default Value',
        'instructions' => 'Specify the default value.',
    ],
];
