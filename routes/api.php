<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\EventRemarksController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Models\EventRemarks;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes for customer signup and login

Route::post('/login', [AuthController::class, 'login'])->name('customer.login');
Route::post('/user', [UserController::class, 'store'])->name('user.store');     //User Signup

// Customer routes (accessible only after login)
Route::middleware(['auth:sanctum', 'customer'])->group(function () {

    Route::get('/customer/dashboard', 'CustomerController@dashboard');

Route::controller(ProfileController::class)->group(function () {
    
    Route::get('/profile/{id}', 'show')->name('profile.show');
    Route::put('/profile/{id}', 'update')->name('profile.update');
});

Route::controller(AppointmentController::class)->group(function () {
    
    Route::post('/appointment', 'store')->name('appointment.store');
    Route::put('/appointment/{id}', 'update_status');
});
});

// Admin routes (accessible only to admins)
Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/admin/dashboard', 'AdminController@dashboard');

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
    Route::get('/user/{id}', 'show');
    Route::put('/user/{id}', 'update')->name('user.update');
    Route::put('/user/email/{id}', 'email')->name('user.email');
    Route::delete('/user/{id}', 'destroy');
});


// Route::controller(EventRemarksController::class)->group(function () {
//     Route::get('/eventremarks/{id}', 'show');
//     Route::put('/eventremarks/{id}', 'update');
//     });
});


// Common routes (accessible only to both)
Route::middleware(['auth:sanctum', 'common'])->group(function () {
    Route::get('/common/dashboard', 'CommonController@dashboard');

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/user/password/{id}', [UserController::class, 'password'])->name('user.password');

    Route::get('/eventremarks', [EventRemarksController::class, 'index']);

Route::controller(AppointmentController::class)->group(function () {
    Route::get('/appointment', 'index');
    Route::get('/appointment/{id}', 'show');
    Route::delete('/appointment/{id}', 'destroy')->name('appointment.delete');
});
    
});