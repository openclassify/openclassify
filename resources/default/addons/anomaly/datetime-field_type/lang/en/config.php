<?php

return [
    'mode'        => [
        'label'        => 'Input Mode',
        'instructions' => 'Do you want to display inputs for date, time, or both?',
        'datetime'     => 'Date + Time',
        'date'         => 'Date',
        'time'         => 'Time',
    ],
    'picker'      => [
        'label'        => 'Date Picker',
        'instructions' => 'Would you like to display a date/time picker?',
        'warning'      => 'If disabled a basic masked input will be displayed.',
    ],
    'date_format' => [
        'label'        => 'Date Format',
        'instructions' => 'Select the format for the date input.',
    ],
    'time_format' => [
        'label'        => 'Time Format',
        'instructions' => 'Select the format for the time input.',
    ],
    'timezone'    => [
        'label'        => 'Timezone',
        'instructions' => 'Select the timezone for the input.',
        'placeholder'  => 'Default Timezone',
    ],
    'step'        => [
        'label'        => 'Minute Step',
        'instructions' => 'Select the minute interval for time input.',
    ],
];
