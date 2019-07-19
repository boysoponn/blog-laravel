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
Auth::routes();
Route::get('/', 'HomeController@index');
Route::name('home')->get('/home', 'HomeController@index');
Route::name('category')->get('/category/{id}', 'PostController@postByCate');

Route::name('post')->get('/post/{id}', 'PostController@index');
Route::name('addPost')->get('/addpost/{id}', 'PostController@addPost');
Route::name('addPostSuccess')->post('/addpost/success/', 'PostController@addPostSuccess');
Route::name('editPost')->get('/editpost/{id}', 'PostController@editPost');
Route::name('editPostSuccess')->post('/editpost/success/{id}', 'PostController@editPostSuccess');
Route::name('commentSuccess')->post('/comment/success/{id}', 'CommentController@commentSuscess');
Route::name('deletePost')->get('/deletePost/{id}', 'PostController@deletePost');

Route::name('cate')->get('/catelist', 'CateController@cate');
Route::name('cateAdd')->post('/cateadd/success', 'CateController@cateadd');
Route::name('cateDelete')->get('/catedelete/{id}', 'CateController@cateDelete');

Route::name('userData')->get('/user/data/{id}', 'PostController@user');
Route::name('userPost')->get('/user/post', 'UserController@userPost');
Route::name('userComment')->get('/user/comment', 'UserController@userComment');
Route::name('userEditEmail')->get('/user/edit/email', 'UserController@userEditEmail');
Route::name('userEditEmailSuccess')->post('/user/edit//email/success', 'UserController@UserEditEmailSuccess');
Route::name('userEditPassword')->get('/user/edit/password', 'UserController@userEditPassword');
Route::name('userEditPasswordSuccess')->post('/user/edit//password/success', 'UserController@userEditPasswordSuccess');
