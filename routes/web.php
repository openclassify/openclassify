<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Storage;

Route::get('/test', function () {
    $filepath = realpath(dirname(__DIR__)).'/storage/demo.json';
    $tables = json_decode(file_get_contents($filepath),true);
    foreach ($tables as $table) {
        if (!empty($table['data'])) {
            $tableName = $table['name'];
            $data = $table['data'];
            Storage::put( 'demo/'  . $tableName . '.json', json_encode($data));
        }
    }
});
