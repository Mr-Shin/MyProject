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


use Illuminate\Support\Facades\Route;

Route::get('/books','BookController@index')->name('books.index');
Route::get('/books/create','BookController@create')->name('books.create');
Route::get('/books/{id}','BookController@show');
Route::get('/books/{id}/edit','BookController@edit')->name("books.edit");
Route::post('/books','BookController@store')->name("books.store");
Route::post('/books/create','BookController@newCategory')->name("category.store");
Route::delete('/books/{id}','BookController@delete')->name('books.delete');
Route::put('/books/{id}','BookController@update')->name("books.update");


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
