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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('notes', 'NoteController');
    Route::get('notes/{note}/delete', 'NoteController@delete')->name('notes.delete');
    Route::get('notes/{id}/restore', 'NoteController@restore')->name('notes.restore');

    Route::resource('tags', 'TagController');
    Route::get('tags/{tag}/notes', 'NoteController@index')->name('tags.notes.index');
    Route::get('tags/{tag}/notes/create', 'NoteController@create')->name('tags.notes.create');

});