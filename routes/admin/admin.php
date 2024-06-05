<?php
use Illuminate\Support\Facades\Route;
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'home'])->name('home');
Route::get('/admin/registerClient', [\App\Http\Controllers\AdminController::class, 'registerClient'])->name
('registerClient');
Route::get('/admin/registerSmartContract', [\App\Http\Controllers\AdminController::class, 'registerSmartContract'])->name('registerSmartContract');
Route::get('/admin/saveSentMessage', [\App\Http\Controllers\AdminController::class, 'saveSentMessage'])->name('saveSentMessage');

Route::get('/admin/saveReceivedMessage', [\App\Http\Controllers\AdminController::class, 'saveReceivedMessage'])->name('saveReceivedMessage');

Route::get('/admin/saveEventDetails', [\App\Http\Controllers\AdminController::class, 'saveEventDetails'])->name('saveEventDetails');


Route::get('/admin/register-success', [\App\Http\Controllers\AdminController::class, 'registerSuccess'])->name('register-success');
Route::get('/admin/saveDaus', [\App\Http\Controllers\AdminController::class, 'saveDaus'])->name('saveDaus'); 
Route::post('/admin/saveUser', [\App\Http\Controllers\UserController::class, 'store'])->name('saveUser');
Route::post('/admin/saveClient', [\App\Http\Controllers\ClientController::class, 'store'])->name('saveClient');
Route::post('/admin/saveSmartContractInSystem', [\App\Http\Controllers\SmartContactController::class, 'store'])->name('saveSmartContractInSystem');
Route::post('/admin/saveReceivedMessageRequest', [\App\Http\Controllers\ReceivedMessageController::class, 'store'])->name('saveReceivedMessageRequest');
Route::post('/admin/saveSentMessageRequest', [\App\Http\Controllers\SentMessageController::class, 'store'])->name('saveSentMessageRequest');
Route::post('/admin/saveEventDetailsRequest', [\App\Http\Controllers\EventDetailsController::class, 'store'])->name('saveEventDetailsRequest');
Route::post('/admin/saveDausRequest', [\App\Http\Controllers\ClientsPlanDausController::class, 'store'])->name('saveDausRequest');
