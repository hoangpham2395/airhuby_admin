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

// Route::get('/', function () {
//     return view('layouts.demo');
// });

// Route::group(['middleware' => ['web']], function () {

// 	// Books
// 	Route::resource('books', 'BooksController');

// });
Route::middleware(['web', 'auth'])->group(function () {
	// Route::prefix('admin')->group(function() {
		Route::get('/', 'UsersController@dashboard');
		Route::get('dashboard', ['uses' => 'UsersController@dashboard', 'as' => 'dashboard']);

		// Route Books
		Route::resource('books', 'BooksController');

		// Route Categories
		Route::get('categories', ['uses' => 'CategoriesController@index', 'as' => 'categories.index']);
		Route::post('categories', ['uses' => 'CategoriesController@store', 'as' => 'categories.store']);
		Route::delete('categories/{category}', ['uses' => 'CategoriesController@destroy', 'as' => 'categories.destroy']);
		Route::patch('categories/{category}', ['uses' => 'CategoriesController@update', 'as' => 'categories.update']);
		// Route::get('categories/{category}', function () { return view('layouts.404'); });

		// Route Users
		Route::resource('users', 'UsersController');
		Route::get('users/{user}/change_password', ['uses' => 'UsersController@getPassword', 'as' => 'users.getPassword']);
		Route::patch('users/{user}/change_password', ['uses' => 'UsersController@changePassword', 'as' => 'users.changePassword']);

		// Route borrows
		Route::get('borrows', ['uses' => 'BorrowController@index', 'as' => 'borrows']);
	// });
});

// Route login

Route::get('login', 'LoginController@getLogin');

Route::post('login', ['uses' => 'LoginController@postLogin', 'as' => 'login']);

Route::get('logout', ['uses' => 'LoginController@getLogout', 'as' => 'logout']);

// Auth::routes();