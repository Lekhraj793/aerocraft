<?php

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

Route::get('/', [App\Http\Controllers\EmployeesController::class, 'index'])->name('index');

Route::group(['prefix' => 'employee', 'as'=>'employee.'], function(){
    Route::get('/create', [App\Http\Controllers\EmployeesController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\EmployeesController::class, 'store'])->name('store');
    Route::get('/delete/{id}', [App\Http\Controllers\EmployeesController::class, 'delete'])->name('delete');
    Route::post('/update/{id}',[App\Http\Controllers\EmployeesController::class, 'update'])->name('update');
    Route::get('/edit/{id}', [App\Http\Controllers\EmployeesController::class, 'edit'])->name('edit');
    Route::get('/view/{id}', [App\Http\Controllers\EmployeesController::class, 'viewEmployee'])->name('view');
});