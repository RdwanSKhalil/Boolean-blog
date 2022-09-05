<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;

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

// Home Get Requests
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Posts Requests
//  Get
Route::get('/post', [PostController::class, 'create'])->name('create-post')->middleware('auth');
Route::get('/post/{id}', [PostController::class, 'show'])->name('show-post');
Route::get('/post/edit/{id}', [PostController::class, 'editShow'])->name('post.editShow');
//  Post
Route::post('/post', [PostController::class, 'store']);
Route::post('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
// Delete
Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy')->middleware("auth");


// Replies Requests
// Get
Route::get('/reply/edit/{id}', [ReplyController::class, 'show'])->name('show-reply');
// Post
Route::post('/comment/reply/{id}', [ReplyController::class, 'store'])->name('reply.store');
Route::post('/reply/edit/{id}', [ReplyController::class, 'edit'])->name('edit-reply');
Route::post('/reply/reply/{id}', [ReplyController::class, 'storeReply'])->name('reply.store-reply');
// Delete
Route::delete('/reply/delete', [ReplyController::class, 'destroy'])->name('reply.destroy');
 

// Users Requests
// Get
Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/users/posts/{id}', [UserController::class, 'posts'])->name('user.posts');
Route::get('/users/comments/{id}', [UserController::class, 'comments'])->name('user.comments');
Route::get('/user/info/{id}', [UserController::class, 'getInfo'])->name('user.info');
// Post
Route::post('/user/image/{id}', [UserController::class, 'storeImg'])->name('user.store-img');
Route::post('/user/info-change/{id}', [UserController::class, 'updateInfo'])->name('user.info-change');
Route::post('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');


// Comments Requests
// Get
Route::get('/comment/edit/{id}', [CommentController::class, 'show'])->name('show-comment');
// Post
Route::post('/post/{id}', [CommentController::class, 'store'])->middleware('auth');
Route::post('/comment/edit/{id}', [CommentController::class, 'edit'])->name('edit-comment');
// Delete
Route::delete('/comment/delete', [CommentController::class, 'destroy'])->name('comment.destroy');
