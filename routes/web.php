<?php

use App\Http\Controllers\admin\CategoreisController;
use App\Http\Controllers\admin\Countryontroller;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateingController;
use App\Models\category;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Translation\MessageCatalogue;

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

Route::get('notifications/{id}',[AdminNotificationController::class,'show'])->name('notification.read');
Route::get('notifications',[AdminNotificationController::class,'index'])->name('notification');


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
Route::get('admin/categoreis/{categorey}', [CategoreisController::class ,'show'])->name('categories.show');
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
Route::resource('admin/role',RolesController::class)->middleware('auth');
Route::resource('admin/country',Countryontroller::class)->middleware('auth');
Route::post('rateing', [RateingController::class ,'store']);

Route::get('products' ,'ProductController@index')->name('products');
Route::get('product/{slug}','ProductController@show')->name('products.detailes');

Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/cart',[CartController::class,'store'])->name('cart');


Route::get('checkout',[CheckoutController::class ,'create'])->name('checkout');
Route::post('checkout',[CheckoutController::class ,'store']);
Route::get('/orders', function () {
return Order::all();
})->name('orders');



Route::get('chat' ,[MessagesController::class,'index'])->name('chat');
Route::post('chat' ,[MessagesController::class,'store'])->name('chat');

// require __DIR__.'/auth.php';
