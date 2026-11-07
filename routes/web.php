<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');
Route::view('/forgot-password', 'auth.forgot-password');
Route::view('/reset-password', 'auth.reset-password');
Route::view('/verify-email', 'auth.verify-email');
Route::view('/verify-email-pending', 'auth.verify-email-pending');
Route::view('/verify-email-result', 'auth.verify-email-result');


