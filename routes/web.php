<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/', [StateController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [StateController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [StateController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [StateController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [StateController::class, 'destroy'])->name('tasks.destroy');
Route::get('/about', function () {
    return 'Hello, Badran';
});
