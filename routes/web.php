<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','WelcomeController@index');

Auth::routes();



//use of route group 

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    //routes for categories created using resource
    Route::resource('categories','CategoriesController');
    
    //post routes using resource
    Route::resource('posts','PostsController')->middleware('auth');
    
    Route::get('trashed-post','PostsController@trashed')->name('trashed-posts.index');
    
    Route::put('restore-post/{post}','PostsController@restore')->name('restore-post');

    Route::resource('tags','TagsController');

});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('users','UsersController@index')->name('users.index');

    Route::put('users/profile','UsersController@update')->name('users.update-profile');

    Route::post('users/{user}/make-admin','UsersController@makeAdmin')->name('users.make-admin');
    Route::get('users/profile','UsersController@edit')->name('users.edit-profile');

});