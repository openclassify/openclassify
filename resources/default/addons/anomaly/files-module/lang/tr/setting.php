<?php

$post = str_replace('M', '', ini_get('post_max_size'));
$file = str_replace('M', '', ini_get('upload_max_filesize'));

$system = $file > $post ? $post : $file;

return [
    "max_upload_size" => [
        "name" => "Maksimum Yükleme Boyutu",
        "instructions" => "Yüklemeler için maksimum dosya boyutunu belirtin.",
        "warning" => "Sunucunuzun maksimum yükleme boyutu şu anda " . $system . " MB",

    ],
    "max_parallel_uploads" => [
        "name" => "Maksimum Paralel Yükleme",
        "instructions" => "Aynı anda yüklenebilecek maksimum dosya sayısını belirtin.",

    ],

];