<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('home');
});


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});


Route::get('/mini-project-page', function () {
    return view('mini-project-page');
});





Route::get('/index', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::resource('posts', PostController::class);


Route::get('/students', [StudentController::class, 'index'])->name('students.index-student');
Route::get('/index-student', [StudentController::class, 'index'])->name('students.index-student');
Route::get('/create-student', [StudentController::class, 'create'])->name('students.create-student');
Route::get('/edit-student', [StudentController::class, 'edit'])->name('students.edit-student');
Route::resource('students', StudentController::class);



Route::get('/index-word', [WordController::class, 'index'])->name('words.index-word');


Route::prefix('words')->group(function () {
    Route::get('/create-word', [WordController::class, 'create'])->name('words.create-word');
    Route::post('/', [WordController::class, 'store'])->name('words.store');
    Route::get('/{word}/edit-word', [WordController::class, 'edit'])->name('words.edit-word');
    Route::put('/{word}', [WordController::class, 'update'])->name('words.update');
    Route::delete('/{word}', [WordController::class, 'destroy'])->name('words.destroy');
});



Route::get('/chat', [ChatController::class, 'index'])->name('chats.chat');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chats.chat-send');
// Route::get('/index-word', [WordController::class, 'index'])->name('words.index-word');
// Route::get('/create-word', [WordController::class, 'index'])->name('words.create-word');
// Route::get('/edit-word', [WordController::class, 'index'])->name('words.edit-word');
// Route::resource('words', WordController::class)->except(['index']);
