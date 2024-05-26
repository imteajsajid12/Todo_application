<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\TodoController::class, 'index'])->name('home');
Route::resource('/todo', \App\Http\Controllers\TodoController::class);
Route::get('/todo/status/{id}', [App\Http\Controllers\TodoController::class, 'status'])->name('todo.status');


