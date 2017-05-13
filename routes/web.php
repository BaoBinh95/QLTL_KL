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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('/users', 'UserController', ['only' => ['index', 'show', 'update']]);
// change password
Route::post('users/password', [
    'as' => 'update_password',
    'uses' => 'Auth\PasswordController@update'
]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => ['admin']], function () {
    // Department Management
    Route::resource('departments', 'DepartmentController', ['except' => ['index', 'show']]);
    //Mange User
    Route::resource('users', 'Admin\UserController', ['except' => ['index', 'show']]);

    //Add User on department
    Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['manager']], function () {
        Route::get('departments/{id}/users/create', [
        'as' => 'admin.departments.users.create',
        'uses' => 'DepartmentController@getcreateUser'
        ]);

        Route::post('departments/{id}/users/store', [
            'as' => 'admin.departments.users.store',
            'uses' => 'DepartmentController@createUser'
        ]);
    });
    //change role manage for a user
    Route::put('users/{user}/setManager', [
        'as' => 'admin.setManager',
        'uses' => 'Admin\UserController@setManager'
    ]);

    Route::get('departments/{department}/documents', [
        'as' => 'departments.documents',
        'uses' => 'DocumentController@documentDepartment'
    ]);
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['admin', 'manager', 'user']], function () {
    // List departments
    Route::get('/departments', [
        'as' => 'departments.index',
        'uses' => 'DepartmentController@index'
    ]);
    //Show department
    Route::get('/departments/{department}', [
        'as' => 'departments.show',
        'uses' => 'DepartmentController@show'
    ]);

    //Manage Typedocument
    Route::resource('typedocuments', 'TypedocumentController');

    //Manage Documents
    Route::resource('documents', 'DocumentController');

    //delete file document
    // Route::resource('documents-file', 'DocumentFileController', ['only' => ['destroy', 'show']]);
    Route::get('documents-file/{file}', [
        'as' => 'documents-file.show',
        'uses' => 'DocumentFileController@show']);

    Route::post('documents-file/{file}', [
        'as' => 'documents-file.destroy',
        'uses' => 'DocumentFileController@destroy']);

    //my documents
    Route::get('mydocuments', [
        'as' => 'user.mydocuments',
        'uses' => 'DocumentController@mydocument'
    ]);

    //List user in a department
    Route::get('departments/{id}/users', [
        'as' => 'admin.departments.users.list',
        'uses' => 'UserController@listUserDepartment'
    ]);

    Route::get('dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'DocumentController@dashboard'
    ]);
});
