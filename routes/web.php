<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Livewire\Home;
use App\Livewire\ProductList;
use App\Livewire\ProductDetail;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use App\Livewire\UserDashboard;
use App\Livewire\WishlistPage;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ProductManager;
use App\Livewire\Admin\CategoryManager;
use App\Livewire\Admin\OrderManager;

// Public routes
Route::get('/', Home::class)->name('home');
Route::get('/products', ProductList::class)->name('products.index');
Route::get('/products/{slug}', ProductDetail::class)->name('products.show');

// Auth routes (User)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/wishlist', WishlistPage::class)->name('wishlist');

    // Payment endpoints
    Route::post('/payment/pay/{order}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
});

// Midtrans callback (No CSRF)
Route::post('/payment/notification', [PaymentController::class, 'callback'])->name('payment.notification');

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');
    Route::get('/products', ProductManager::class)->name('products');
    Route::get('/categories', CategoryManager::class)->name('categories');
    Route::get('/orders', OrderManager::class)->name('orders');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
