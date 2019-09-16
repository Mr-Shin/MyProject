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
Route::get('/books/{id}','BookController@show')->name('books.show');
Route::get('/books/{id}/edit','BookController@edit')->name("books.edit");
Route::post('/books','BookController@store')->name("books.store");
Route::post('/books/create','CategoryController@store')->name("category.store");
Route::post('/books/reply','ReplyController@store')->name("reply.store");
Route::post('/books/{id}/comment','CommentController@store')->name("comment.store");
Route::delete('/books/{id}/{comment}','CommentController@destroy')->name("comment.delete");
Route::delete('/books/{id}/comments/replies/{reply}','ReplyController@destroy')->name('reply.delete');
Route::delete('/books/{id}','BookController@delete')->name('books.delete');
Route::put('/{user}/edit/1', 'HomeController@update')->name('profile.update');
Route::put('/books/{id}','BookController@update')->name("books.update");
Route::get('/categories/{category}','CategoryController@show')->name('category.show');

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/{user}/profile', 'HomeController@profile')->name('profile');
Route::get('/{user}/edit', 'HomeController@edit')->name('profile.edit');
Route::get('/admin/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/admin/posts', 'HomeController@posts')->name('posts');
Route::delete('/admin/posts/{post}', 'HomeController@delete')->name('post.delete');
Route::get('/admin/notifications', 'HomeController@notifications')->name('notifications');
Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart', 'CartController@add')->name('cart.add');
Route::delete('/cart/{id}', 'CartController@remove')->name('cart.remove');
