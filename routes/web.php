<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\ProductSyncController;
use App\Http\Controllers\CarFinderController;
 /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index'])->name('home');

// المنتجات (صفحة التفاصيل)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
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


// مسار الفلترة حسب النوع (Type)
Route::get('/type/{type}', [ProductController::class, 'byType'])->name('products.byType');// مسارات الملف الشخصي (تسجيل الدخول والطلبات)
Route::middleware('auth')->group(function () {
    // مسار Breeze لتعديل الملف الشخصي
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ✅ مسارنا لعرض طلبات الزبون
    Route::get('/mon-compte', [ProfileController::class, 'index'])->name('profile.index');
});
// مسارات المزامنة (لا تتطلب CSRF لأنها API)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sync-product', [ProductSyncController::class, 'sync']);
    Route::post('/delete-product', [ProductSyncController::class, 'destroy']);
});
// مسار البحث في الموقع
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
// مسار مؤقت لتوليد توكن (احذفه بعد الحصول على التوكن)
Route::get('/generate-token', function () {
    $user = App\Models\User::firstOrCreate(
        ['email' => 'admin@khaled.com'],
        ['name' => 'Admin', 'password' => bcrypt('password')]
    );
    $token = $user->createToken('pos-sync-token')->plainTextToken;
    return "Your API Token is: <br><textarea style='width:100%; height:100px; font-size:18px;'>". $token ."</textarea>";
});
// مسارات البحث المتسلسل عن قطع الغيار
Route::get('/car-finder/{brand}', [CarFinderController::class, 'showModels'])->name('car.models');
Route::get('/car-finder/{brand}/{model}', [CarFinderController::class, 'showYears'])->name('car.years');
Route::post('/car-finder/{brand}/{model}/parts', [CarFinderController::class, 'getParts'])->name('car.parts');
Route::get('/check-toyota', function () {
    $products = App\Models\Product::where('car_brand', 'Toyota')->get(['name', 'car_brand', 'car_model', 'years']);
    return $products;
});


// مسارات البحث المتسلسل عن قطع الغيار
Route::get('/car-finder/{brand}', [CarFinderController::class, 'showModels'])->name('car.models');
Route::get('/car-finder/{brand}/{model}', [CarFinderController::class, 'showYears'])->name('car.years');
Route::post('/car-finder/{brand}/{model}/parts', [CarFinderController::class, 'getParts'])->name('car.parts');
Route::get('/check-cars', function () {
    return \App\Models\CarCatalog::all();
});
require __DIR__.'/auth.php';