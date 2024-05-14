<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[\App\Http\Controllers\WebController::class, 'home'])->name('web.home');

Route::get('/register',[\App\Http\Controllers\WebController::class, 'registerUser'])->name('register');

Route::get('/login',[\App\Http\Controllers\WebController::class, 'loginUser'])->name('login');
Route::get("/about", [\App\Http\Controllers\WebController::class, 'about'])->name('about');
Route::get("/contact", [\App\Http\Controllers\WebController::class, 'contact'])->name('contact');
Route::get("/forgot-password", [\App\Http\Controllers\WebController::class, 'forgotPassword'])->name('forgot-password');
Route::get("/input-code", [\App\Http\Controllers\WebController::class, 'inputCode'])->name('input-code');
Route::post("/verifyLogin", [\App\Http\Controllers\UserController::class, 'login'])->name('verifyLogin');
Route::post("/sendEmailRecoveryPassword", [\App\Http\Controllers\WebController::class, 'sendEmailRecoveryPassword'])->name('sendEmailRecoveryPassword');
Route::post("/VerifyCodeEmailRecovery", [\App\Http\Controllers\WebController::class, 'VerifyCodeEmailRecovery'])->name('VerifyCodeEmailRecovery');
Route::post("/saveNewPassword", [\App\Http\Controllers\WebController::class, 'registerNewPassword'])->name('saveNewPassword');
Route::post("/sendEmailContact", [\App\Http\Controllers\WebController::class, 'sendEmailContact'])->name('sendEmailContact');
