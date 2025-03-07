<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\OfferController;

Route::get('/', function () {
    return view('home'); ;
})->name('home');
Route::get('offers.index', [OfferController::class, 'index'])->name('offers.index');

Route::middleware([AuthCheck::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //routes for admin
    Route::middleware([CheckRole::class.':1'])->group(function () {
       Route::get('/admin.dashboard',[Admincontroller::class,'index'])->name('Admin.dashboard');
       Route::get('/admin.dashboard.role',[RoleController::class,'index'])->name('admin.dashboard.role');
       Route::resource('/role', RoleController::class);
       Route::resource('/user', UserController::class);
       Route::post('/users/update-role',[UserController::class,'updateRole'])->name('users.updateRole');
    });
    //routes for client
    Route::middleware([CheckRole::class.':2'])->group(function () {
        Route::get('/client', [AuthController::class, 'client'])->name('client');
    });
    //routes for society
    Route::middleware([CheckRole::class.':3'])->group(function () {
        Route::get('/society.dashboard',[SocietyController::class,'index'])->name('society.dashboard');
        Route::get('/society.dashboard.offer',[SocietyController::class,'offerDashboard'])->name('society.dashboard.offer');
        Route::resource('/offer', OfferController::class);
        Route::get('/society', [AuthController::class, 'society'])->name('society');
        Route::post('/offers/toggle-status/{id}', [SocietyController::class, 'toggleStatus'])->name('offers.toggleStatus');

    });

});
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

