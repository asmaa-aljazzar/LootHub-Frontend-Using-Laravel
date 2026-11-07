<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

// Auth
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');
Route::view('/forgot-password', 'auth.forgot-password');
Route::view('/reset-password', 'auth.reset-password');
Route::view('/verify-email', 'auth.verify-email');
Route::view('/verify-email-pending', 'auth.verify-email-pending');
Route::view('/verify-email-result', 'auth.verify-email-result');

// Admin
Route::view('/admin/panel', 'admin.panel.index');
Route::view('/admin/categories', 'admin.categories.index');
Route::view('/admin/categories/show', 'admin.categories.show');


// Customer orders (frontend previews)
Route::view('/orders', 'orders.index');
Route::view('/orders/details', 'orders.show');

Route::view('/profile', 'profile.index');

Route::view('/favorites', 'favorites.index');

Route::view('/cart', 'cart.index');

Route::view('/checkout', 'checkout.index');
Route::view('/checkout/verify', 'checkout.verify');
Route::view('/checkout/success', 'checkout.success');

// Frontend product and AI previews
Route::view('/products', 'admin.products.index');
Route::view('/products/show', 'admin.products.show');
Route::view('/products/{id}', 'admin.products.show')->whereNumber('id');
Route::view('/admin/products/create', 'admin.products.create');
Route::view('/ai', 'ai.chat');
Route::view('/ai/image', 'ai.image');
Route::view('/preview/not-found', 'errors.friendly-404');
Route::view('/admin/users', 'admin.users.index');
Route::view('/admin/products', 'admin.products.management');
Route::view('/admin/orders', 'admin.orders.index');
Route::view('/admin/promos', 'admin.promos.index');
Route::view('/admin/reviews', 'admin.reviews.index');
Route::view('/admin/settings', 'admin.settings.index');
