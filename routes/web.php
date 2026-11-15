<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
Route::get('/', [StateController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [StateController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit', [StateController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}', [StateController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [StateController::class, 'destroy'])->name('tasks.destroy');
Route::get('/about', function () {
    return 'Hello, Badran';
});
