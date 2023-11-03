<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController as TaskController;
use App\Http\Controllers\UserController;

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


Route::middleware(['auth'])->group(function () {
    // Route::resource('tasks', TaskController::class);
    Route::get('tasks/{task}', [TaskController::class, 'show']);
    Route::POST('tasks/delete/{task}', [TaskController::class, 'destroy']);
    Route::post('tasks/{task}', [TaskController::class, 'update']);
    Route::POST('tasks', [TaskController::class, 'store']);
    Route::POST('searchTasks/{id}', [TaskController::class, 'search']);
    Route::get('tasks/status/{taskId}/{userId}', [TaskController::class, 'changeStatus']);
    Route::get('logout', [UserController::class, 'logout']);
});
Route::middleware(['guest'])->group(function () {
    Route::POST('register', [UserController::class, 'register']);
    Route::POST('login', [UserController::class, 'login']);

    Route::get('/login', function () {
        return view('login');
    });
    Route::get('/', function () {
        return view('welcome');
    });
});
