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
    Route::get('notes/{id}/delete', 'NoteController@delete')->name('notes.delete');
    Route::get('notes/{id}/restore', 'NoteController@restore')->name('notes.restore');

    Route::resource('tags', 'TagController');
    Route::get('tags/{id}/notes', 'NoteController@index')->name('tags.notes.index');
    Route::get('tags/{id}/notes/create', 'NoteController@create')->name('tags.notes.create');

    Route::get('uploads', 'UploadController@index')->name('uploads.index');
    Route::get('uploads/{id}/delete', 'UploadController@delete')->name('uploads.delete');
    Route::get('files/{id}/restore', 'UploadController@restore')->name('uploads.restore');

});
