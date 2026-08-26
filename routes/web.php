<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// المنتجات (صفحة التفاصيل)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// السلة (Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// ✅ إتمام الطلب (Checkout) - محمي بتسجيل الدخول
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// صفحة النجاح غير محمية لكي يراها الزبون بعد الطلب
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// لوحة التحكم (Dashboard) الخاصة بـ Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// مسارات الملف الشخصي (تسجيل الدخول والطلبات)
Route::middleware('auth')->group(function () {
    // مسار Breeze لتعديل الملف الشخصي
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ✅ مسارنا لعرض طلبات الزبون
    Route::get('/mon-compte', [ProfileController::class, 'index'])->name('profile.index');
});

// مسارات API للمزامنة
Route::middleware('auth:sanctum')->post('/delete-product', [App\Http\Controllers\Api\ProductSyncController::class, 'destroy']);

// مسارات المصادقة (تسجيل الدخول/إنشاء حساب)
require __DIR__.'/auth.php';