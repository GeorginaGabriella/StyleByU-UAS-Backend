<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart-item/{cartItem}', [CartItemController::class, 'update'])->name('cart-item.update');
    Route::delete('/cart-item/{cartItem}', [CartItemController::class, 'destroy'])->name('cart-item.destroy');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::post('/checkout/prepare', [CheckoutController::class, 'prepare'])->name('checkout.prepare');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::get('/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit', [UserController::class, 'update'])->name('user.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/items', [OrderItemController::class, 'index'])->name('order_items.index');

    Route::get('/payments/pay/{order}', [PaymentController::class, 'pay'])->name('payments.pay');
    Route::post('/payments/pay/{order}', [PaymentController::class, 'process'])->name('payments.process');

    Route::get('/reviews/product/{productId}', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create/{productId}/{orderId}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::put('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->whereNumber('product')
    ->name('products.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('banners', BannerController::class);

    Route::resource('products', ProductController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::get('/products/{product}/variants', [ProductVariantController::class, 'index'])->name('variants.index');
    Route::post('/products/{product}/variants', [ProductVariantController::class, 'store'])->name('variants.store');
    Route::get('/variants/{variant}/edit', [ProductVariantController::class, 'edit'])->name('variants.edit');
    Route::put('/variants/{variant}', [ProductVariantController::class, 'update'])->name('variants.update');
    Route::delete('/variants/{variant}', [ProductVariantController::class, 'destroy'])->name('variants.destroy');

    Route::get('/admin/shipping', [ShippingController::class, 'index'])->name('admin.shipping.index');

    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    Route::get('/admin/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/admin/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/admin/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::delete('/admin/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
});