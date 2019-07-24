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
Route::name('home')->get('/', 'HomeController@index');

Route::name('login')->post('/login', 'Auth\LoginController@login');

Route::name('adminUser')->get('/admin/user', 'AdminController@adminUser');
Route::name('adminLogin')->get('/admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::name('adminLoginSuccess')->post('/admin/login', 'Auth\AdminLoginController@login');    
Route::name('adminBan')->get('/admin/ban/{id}', 'AdminController@adminBan');
Route::name('adminBanSuccess')->post('/admin/ban/success/{id}', 'AdminController@adminBanSuccess');
Route::name('adminBanCancel')->get('/admin/ban/cancel/{id}', 'AdminController@adminBanCancel');

Route::name('deletePostByadmin')->get('/deletePostByadmin/{id}', 'PostController@deletePostByadmin');
Route::name('deleteCommentByadmin')->get('/deleteCommentByadmin/{id}', 'PostController@deleteCommentByadmin');

Route::name('category')->get('/category/{id}', 'PostController@postByCate');

Route::name('post')->get('/post/{id}', 'PostController@index');
Route::name('addPost')->get('/addpost/{id}', 'PostController@addPost');
Route::name('addPostSuccess')->post('/addpost/success/', 'PostController@addPostSuccess');
Route::name('editPost')->get('/editpost/{id}', 'PostController@editPost');
Route::name('editPostSuccess')->post('/editpost/success/{id}', 'PostController@editPostSuccess');
Route::name('commentSuccess')->post('/comment/success/{id}', 'CommentController@commentSuscess');
Route::name('deletePost')->get('/deletePost/{id}', 'PostController@deletePost');

Route::name('cate')->get('/catelist', 'CateController@cate');
Route::name('cateAdd')->post('/cate/add/success', 'CateController@cateadd');
Route::name('cateDelete')->get('/cate/delete/{id}', 'CateController@cateDelete');
Route::name('cateHidden')->get('/cate/hidden/{id}', 'CateController@cateHidden');
Route::name('cateShow')->get('/cate/show/{id}', 'CateController@cateShow');
Route::name('cateEdit')->get('/cate/edit/{id}', 'CateController@cateEdit');
Route::name('cateEditSuccess')->post('/cate/edit/success/{id}', 'CateController@cateEditSuccess');

Route::name('userData')->get('/user/data/{id}', 'PostController@user');
Route::name('userPost')->get('/user/post', 'UserController@userPost');
Route::name('userComment')->get('/user/comment', 'UserController@userComment');
Route::name('userEditEmail')->get('/user/edit/email', 'UserController@userEditEmail');
Route::name('userEditEmailSuccess')->post('/user/edit/email/success', 'UserController@UserEditEmailSuccess');
Route::name('userEditPassword')->get('/user/edit/password', 'UserController@userEditPassword');
Route::name('userEditPasswordSuccess')->post('/user/edit//password/success', 'UserController@userEditPasswordSuccess');



