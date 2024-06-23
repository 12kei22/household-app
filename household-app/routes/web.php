<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SpendingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects/store', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('projects/{projectId}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('projects/{projectId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('projects/{projectId}/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('projects/{projectId}/tasks/{taskId}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('projects/{projectId}/tasks/{taskId}/spendings', [SpendingController::class, 'index'])->name('spendings.index');
    Route::get('projects/{projectId}/tasks/{taskId}/spendings/create', [SpendingController::class, 'create'])->name('spendings.create');
    Route::post('projects/{projectId}/tasks/{taskId}/spendings/store', [SpendingController::class, 'store'])->name('spendings.store');
    Route::get('projects/{projectId}/tasks/{taskId}/spendings/{spendingId}/edit', [SpendingController::class, 'edit'])->name('spendings.edit');
    Route::put('projects/{projectId}/tasks/{taskId}/spendings/{spendingId}/update', [SpendingController::class, 'update'])->name('spendings.update');
    Route::delete('projects/{projectId}/tasks/{taskId}/spendings/{spendingId}/destroy', [SpendingController::class, 'destroy'])->name('spendings.destroy');
});

require __DIR__.'/auth.php';
