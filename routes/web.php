<?php

use App\Http\Controllers\admin\CategoreisController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layout.admin.master-layout');
});

// ------------------------- --Route Categorey -----------------------------------
Route::get('admin/categoreis', [CategoreisController::class ,'index'])->name('categories.index');
Route::get('admin/categoreis/create', [CategoreisController::class ,'create'])->name('categories.create');
Route::post('admin/categoreis', [CategoreisController::class ,'store'])->name('categories.stroe');
Route::get('admin/categoreis/{id}', [CategoreisController::class ,'show'])->name('categories.show');
Route::get('admin/categoreis/{id}/edit', [CategoreisController::class ,'edit'])->name('categories.edit');
Route::put('admin/categoreis/{id}', [CategoreisController::class ,'update'])->name('categories.update');
Route::delete('admin/categoreis/{id}', [CategoreisController::class ,'destroy'])->name('categories.destroy');

// ------------------------- End Route Categorey -----------------------------------
