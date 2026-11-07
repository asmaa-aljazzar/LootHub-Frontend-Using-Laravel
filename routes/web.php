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
