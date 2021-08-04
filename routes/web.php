<?php

use App\Http\Controllers\admin\CategoreisController;
use App\Http\Controllers\admin\ProductsController;
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
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' ,'verified'])->name('dashboard');
// Route::get('/', function () {
//     return view('layout.admin.master-layout');
// });

// ------------------------- --Route Categorey -----------------------------------
Route::get('admin/categoreis',[CategoreisController::class ,'index'])->name('categories.index')->middleware('verified');
Route::get('admin/categoreis/create', [CategoreisController::class ,'create'])->name('categories.create');
Route::post('admin/categoreis', [CategoreisController::class ,'store'])->name('categories.store');
Route::get('admin/categoreis/{id}', [CategoreisController::class ,' '])->name('categories.show');
Route::get('admin/categoreis/{id}/edit', [CategoreisController::class ,'edit'])->name('categories.edit');
Route::put('admin/categoreis/{id}', [CategoreisController::class ,'update'])->name('categories.update');
Route::delete('admin/categoreis/{id}', [CategoreisController::class ,'destroy'])->name('categories.destroy');

// ------------------------- End Route Categorey -----------------------------------

// ----------------------------- Route Product --------------------------------------
Route::get('admin/product/trash',[ProductsController::class ,'trash'])->name('products.trash')->middleware('auth');
Route::put('admin/product/trash/{id?}',[ProductsController::class ,'restore'])->name('products.restore')->middleware('auth');
Route::delete('admin/product/trash/{id?}',[ProductsController::class ,'ForceDelete'])->name('products.force-delete')->middleware('auth');

Route::resource('admin/product',ProductsController::class)->middleware('auth');
//------------------------------ End Route Product -----------------------------------

require __DIR__.'/auth.php';
