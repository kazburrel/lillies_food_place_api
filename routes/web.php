<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('/admin')->middleware([])->group(function() {
    Route::get('dashboard', [ViewController::class, 'dashboardView']);
    Route::get('all_users', [ViewController::class, 'usersView']);  
    Route::put('all_users/{user}', [AdminController::class, 'updateUser']);  
    Route::get('add_users', [ViewController::class, 'addUsersView']);
    Route::post('add_users', [AdminController::class, 'registerUser']);
    Route::delete('all_users/{user}', [AdminController::class, 'destroyUser'])->name('userDestroy');  
    Route::get('/all_users/{user}', [AdminController::class, 'blockUser']);

    // VENDORS
    Route::get('/all_vendors', [ViewController::class, 'vendorView']);
    Route::get('/all_vendors/{vendor}', [AdminController::class, 'blockVendor']);
    Route::delete('all_vendors/{vendor}', [AdminController::class, 'destroyVendor']);  
    Route::put('all_vendors/{vendor}', [AdminController::class, 'updateVendor']);
    Route::get('add_vendors', [ViewController::class, 'addVendorView']);
    Route::post('add_vendors', [AdminController::class, 'registerVendor']);


    // MEALS
    Route::get('all_meals', [ViewController::class, 'mealsview']);
    Route::post('add_meals', [AdminController::class, 'addMeal']);
    Route::get('/all_meals/{meals}', [AdminController::class, 'status']);

});
