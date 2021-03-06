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

Route::get('/', 'TaskController@index');
Route::get('/tasklist', 'TaskController@tasklist');
Route::post('/new', 'TaskController@create');
Route::post('/regist', 'TaskController@update');
Route::post('/update', 'TaskController@update');
Route::post('/update', 'TaskController@update');
Route::post('/updtask/{id}', 'TaskController@updtask');
Route::post('/remove/{id}', 'TaskController@remove');

Route::get('/info', function () {
    return phpinfo();
});

use \App\Task;

Route::get('/test', function(){
    $showdata = "";
    //$tasks = \App\Task::where('id', 1)->get();
    $tasks = \App\Task::find(1);

    return Response::JSON($tasks);
});

Route::get('/foo/{user}', function ($username) {
    return $username;
});
