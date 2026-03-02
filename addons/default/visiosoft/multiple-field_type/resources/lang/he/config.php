<?php

return [
    'related'    => [
        'label'        => 'זרם קשור',
        'instructions' => 'ציין את ערכי הזרם הקשורים שיוצגו בתפריט הנפתח.',
    ],
    'mode'       => [
        'label'  => 'מצב קלט',
        'option' => [
            'tags'       => 'תגים',
            'lookup'     => 'הבט מעלה',
            'checkboxes' => 'תיבות סימון',
        ],
    ],
    'min'        => [
        'label'        => 'בחירות מינימליות',
        'instructions' => 'ציין את המספר המינימלי של הבחירות המותרות.',
    ],
    'max'        => [
        'label'        => 'בחירות מרביות',
        'instructions' => 'ציין את המספר המרבי של הבחירות המותרות.',
    ],
    'title_name' => [
        'label'        => 'שדה כותרת',
        'placeholder'  => 'שם פרטי',
        'instructions' => 'ציין את <strong>שבלול</strong> של השדה לתצוגה עבור אפשרויות נפתחות / חיפוש.<br>ניתן לציין כותרות ניתנות כמו <strong>{entry.first_name} {entry.last_name}</strong><br>בעמודת הכותרת של הזרם הקשור ישמש כברירת מחדל.',
    ],
];
