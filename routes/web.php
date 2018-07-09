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
    return view('welcome');
});

Route::post('/createUser', 'UserController@createNew');
Route::delete('/deleteUser/{handle}', 'UserController@delete');
Route::put('/updateHandle', 'UserController@update');

Route::get('/getAllLists/{handle}', 'ListsController@getAll');
Route::post('/createList', 'ListsController@createNew');
Route::delete('/deleteList/{list_id}', 'ListsController@delete');
Route::put('/updateList', 'ListsController@update');

Route::post('/addTask', 'TaskController@createNew');
Route::get('/getAllTasks/{list_id}', 'TaskController@getAll');
Route::delete('/deleteTask/{task_id}', 'TaskController@delete');
Route::put('/updateTask', 'TaskController@update');
