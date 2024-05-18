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

    Route::get('projects',[ProjectController::class,'index'])->name('projects.index');

    Route::get('projects/create',[ProjectController::class,'create'])->name('projects.create');

    Route::post('project/store',[ProjectController::class,'store'])->name('projects.store');

    Route::get('projects/{id}/tasks/index',[TaskController::class,'index'])->name('tasks.index');

    Route::get('projects/{id}/spendings/index',[SpendingController::class,'index'])->name('spendings.index');

    Route::get('projects/{id}/tasks/create',[TaskController::class,'create'])->name('tasks.create');

    Route::post('projects/{id}/tasks/store',[TaskController::class,'store'])->name('tasks.store');

    Route::get('projects/{id}/tasks/create2',[TaskController::class,'create2'])->name('tasks.create2');

    Route::post('projects/{id}/spendings/store',[TaskController::class,'store'])->name('spendings.store');

    Route::get('projects/{id}/spendings/edit/{spendingId}',[SpendingController::class,'edit'])->name('spendings.edit');

    Route::get('projects/{id}/spendings/create/{spendingId}',[SpendingController::class,'create'])->name('spendings.create');

    Route::post('projects/{id}/spendings/update/{spendingId}',[SpendingController::class,'update'])->name('spendings.update');

    Route::post('projects/{id}/spendings/destroy/{spendingId}',[SpendingController::class,'destroy'])->name('spendings.destroy');
});

require __DIR__.'/auth.php';
