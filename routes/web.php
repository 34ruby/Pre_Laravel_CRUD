<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
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

Route::resource('/posts', PostsController::class)
    ->middleware(['auth']);

Route::delete('/posts/images/{id}', [PostsController::class,"deleteImage"])
    ->middleware(['auth']);

// Route::get('posts', [PostsController::class, 'index'])
//     ->name('posts.index');

// Route::Post('/posts', [PostsController::class, 'store'])

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/like/{post}', [LikesController::class, "store"])
->middleware(['auth'])->name('like.store');

// Route::get('/comments/{postId}', [CommentsController::class, "index"])->name('comments.index');
// // http::/localhost:8000/comments/3
// // 이 게시글에 해당하는 댓글을 주세요

// Route::patch('/comments/{commentId}', [CommentsController::class, "update"])->name('comments.index');
// // http::/localhost:8000/comments/3

// Route::delete('/comments/{commentId}', [CommentsController::class, "delete"])->name('comments.index');

// Route::post('/comments/{commentId}', [CommentsController::class, 'store'])->name('comments.index');

Route::post('/comments/{postId}', [CommentsController::class, 'store']);

Route::get('/comments/{postId}', [CommentsController::class, 'index']);

Route::patch('/comments/{commentId}', [CommentsController::class, 'update']);

Route::delete('/comments/{commentId}', [CommentsController::class, 'destroy']);

/*
Route::get('/comment/index', [CommentController::class, "index"])->middleware(['auth']);

Route::post('/comment/store', [CommentController::class, "store"])->middleware(['auth']);

Route::delete('/comment/{id}', [CommentController::class, "deleteComment"])->middleware(['auth']);
*/

require __DIR__.'/auth.php';
