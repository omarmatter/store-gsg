<?php

use App\Models\category;
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
Route::get('admin/categoreis', [category::class ,'index'])->name('categoreis.index');
Route::get('admin/categoreis/create', [category::class ,'create'])->name('categoreis.create');
Route::post('admin/categoreis', [category::class ,'store'])->name('categoreis.stroe');
Route::get('admin/categoreis/{id}', [category::class ,'show'])->name('categoreis.show');
Route::get('admin/categoreis/{id}/edit', [category::class ,'edit'])->name('categoreis.edit');
Route::put('admin/categoreis/{id}', [category::class ,'update'])->name('categoreis.update');
Route::delete('admin/categoreis/{id}', [category::class ,'destroy'])->name('categoreis.destroy');

// ------------------------- End Route Categorey -----------------------------------
