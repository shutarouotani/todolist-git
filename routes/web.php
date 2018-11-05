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

/*
Route::get('/', function () {
    //return view('auth.login');
    return view('welcome');
});
*/

Route::get('/', 'TasksController@index');

Route::get('create', function () {
    return view('welcome');
});

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['show']]);
    Route::post('upload', 'UsersController@upload')->name('upload.post');
    Route::resource('tasks', 'TasksController');
    
    Route::resource('subtasks', 'SubTasksController', ['only' => ['index', 'show', 'create', 'store', 'update', 'destroy']]);
    
    Route::resource('discussions', 'DiscussionsController', ['only' => ['store']]);
    Route::get('/tasks/{id}/discussions', 'TasksController@discussions')->name('tasks.discussions');
    
    Route::get('/tasks/{id}/members', 'UserTaskController@members')->name('tasks.members');
    Route::post('/tasks/{id}/changemember', 'UserTaskController@changemember')->name('changemember.post');
});
