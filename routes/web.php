<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', function () {
    return [
        ['id' => 1, 'name' => 'John Doe'],
        ['id' => 2, 'name' => 'Jane Smith'],
    ];
});
//react open files
Route::get('/{any}', function () {
    return file_get_contents(public_path('react/index.html'));
})->where('any', '.*');
