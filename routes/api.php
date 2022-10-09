<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VendorController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource('users', UserController::class);
// SUPER ADMIN
Route::group(['middleware' => ['auth:sanctum', 'role:admin']], function () {
    Route::post('meals', [MealController::class, 'storeMeal']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::get('vendors', [VendorController::class, 'showVendor']);
    Route::get('vendors/{id}', [VendorController::class, 'searchVendor']);
    Route::get('admin/details', [AdminController::class, 'showAdminDetails']);
});


// USERS 
Route::group(['middleware' => ['auth:sanctum', 'role:user', 'status']], function () {
    Route::get('user/details', [UserController::class, 'showUserdetails']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('order', [UserController::class, 'addOrder']);
});

// VENDORS
Route::group(['middleware' => ['auth:sanctum', 'role:vendor', 'status']], function () {
    Route::get('vendor/details', [VendorController::class, 'showVendorDetails']);
    Route::post('meals', [MealController::class, 'storeMeal'])->middleware('status');
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::post('users', [UserController::class, 'registerUser']);
Route::post('admin', [AdminController::class, 'registerAdmin']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('vendors', [VendorController::class, 'registerVendor']);
Route::get('meals', [MealController::class, 'showMeal']);
Route::get('mealsSearch/{id}', [MealController::class, 'searchMeal']);
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);
