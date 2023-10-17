<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController; 
use App\Http\Controllers\CustomAuthController; 
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ForumPostController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant.index')->middleware('can:see-users');
Route::get('/etudiant-create', [EtudiantController::class, 'create'])->name('etudiant.create')->middleware('can:create-users'); 
Route::post('/etudiant-create', [EtudiantController::class, 'store']); 
Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show')->middleware('auth'); 
Route::get('/etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit')->middleware('can:edit-users'); 
Route::put('/etudiant-edit/{etudiant}', [EtudiantController::class, 'update']); 
Route::delete('/etudiant-edit/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete')->middleware('can:delete-users'); 

Route::get('/', [ForumPostController::class, 'index'])->name('forum.index')->middleware('auth');
Route::get('/forum-create', [ForumPostController::class, 'create'])->name('forum.create')->middleware('auth'); 
Route::post('/forum-create', [ForumPostController::class, 'store']); 
Route::get('/forum/{forumPost}', [ForumPostController::class, 'show'])->name('forum.show')->middleware('auth'); 
Route::get('/forum-edit/{forumPost}', [ForumPostController::class, 'edit'])->name('forum.edit')->middleware('can:edit-forum-posts'); 
Route::put('/forum-edit/{forumPost}', [ForumPostController::class, 'update']); 
Route::delete('/forum-edit/{forumPost}', [ForumPostController::class, 'destroy'])->name('forum.delete')->middleware('can:delete-forum-posts'); 

Route::get('/login', [CustomAuthController::class, 'index'])->name('login'); 
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout'); 

Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang'); 

Route::get('/file', [FileController::class, 'index'])->name('file.index')->middleware('auth');
Route::get('/file-create', [FileController::class, 'create'])->name('file.create')->middleware('auth'); 
Route::post('/file-create', [FileController::class, 'store']); 
Route::get('/file/{file}', [FileController::class, 'show'])->name('file.show')->middleware('auth'); 
Route::get('/file-edit/{file}', [FileController::class, 'edit'])->name('file.edit')->middleware('auth'); 
Route::put('/file-edit/{file}', [FileController::class, 'update']); 
Route::delete('/file-edit/{file}', [FileController::class, 'destroy'])->name('file.delete')->middleware('auth'); 
Route::get('/file-pdf/{file}', [FileController::class, 'showPDF'])->name('file.showPDF');