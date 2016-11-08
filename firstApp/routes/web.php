<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    # return redirect()->route('/foo/barbaz');
    # return "hello world";
    # return view('welcome');
    return env('DB_HOST', "<none>") . ",   " . env('DB_DATABASE', "<none>") . ",   " . env('DB_USERNAME', "<none>") . ",   " . env('DB_PASSWORD', "<none>");
});

Route::get('/test', 'TaskController@test');


Route::get('/foo/{user}', function ($username) {
    return $username;
});
