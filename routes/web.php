<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;

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

// Route::get('/', function () {
//   return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/shop', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/search', [CustomerController::class, 'search'])->name('customer.search');

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

    Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/mycart', [CartController::class, 'index'])->name('cart');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

Route::middleware(['auth','is_admin'])->group(function () {
    // need for improvement
    Route::get('/adminhome', [HomeController::class, 'adminHome'])->name('admin.home');

    //Ok na to
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');

    //Ok na to
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::get('/inventory/{productId}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('/inventory/{productId}/update', [InventoryController::class, 'update'])->name('inventory.update');

    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/order/{id}/update', [OrderController::class, 'update'])->name('order.update');

    Route::get('/generate-analytics', [AdminController::class, 'generateInventoryChart'])->name('analytics');
    Route::get('/product/datatable', [ProductController::class, 'producttable'])->name('product.datatable'); //di pa maayos | saka na to
});

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
