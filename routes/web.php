<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TodolistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});


Route::get('/home', [TodolistController::class, 'showTodolistPage'])->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginPage'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [LoginController::class, 'showRegisterPage'])->middleware('guest');
Route::post('/register', [LoginController::class, 'register'])->middleware('guest');

Route::post('/todolist', [TodolistController::class, 'addTodo'])->middleware('auth');
Route::delete('/todolist/{todo_id}', [TodolistController::class, 'deleteTodo'])->middleware('auth');
Route::put('/todolist/check/{todo_id}', [TodolistController::class, 'checkTodo'])->middleware('auth');
