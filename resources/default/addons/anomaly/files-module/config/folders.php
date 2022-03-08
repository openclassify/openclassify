<?php

return [
    'public' => array_filter(explode(',', env('PUBLIC_FOLDERS'))),
];
