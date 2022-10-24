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


// USERS 
Route::group(['middleware' => ['auth:sanctum', 'role:user', 'status']], function () {
    Route::get('user/details', [UserController::class, 'showUserdetails']);
    Route::post('order', [UserController::class, 'addOrder']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('order_payment/details', [UserController::class, 'makePaymentDetails']);
    Route::post('update_profile/{id}', [UserController::class, 'profileUpdate']);
    Route::post('update_password', [UserController::class, 'passwordUpdate']);
});

// VENDORS
Route::group(['middleware' => ['auth:sanctum', 'role:vendor', 'status']], function () {
    Route::get('vendor/details', [VendorController::class, 'showVendorDetails']);
    Route::post('meals', [MealController::class, 'storeMeal']);
    Route::post('meal_update/{meal}', [MealController::class, 'updateMeal']);
    Route::post('meal_delete/{meal}', [MealController::class, 'destroyMeal']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('update_profile/{id}', [VendorController::class, 'profileUpdate']);
});


Route::group(['middleware' => ['guest']], function () {
    Route::get('vendors', [VendorController::class, 'showVendor']);
    Route::get('vendors/{id}', [VendorController::class, 'searchVendor']);
    Route::get('vendor_meal/{id}', [VendorController::class, 'getVendoMeals']);
    Route::post('users', [UserController::class, 'registerUser']);
    Route::post('admin', [AdminController::class, 'registerAdmin']);
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::post('vendors', [VendorController::class, 'registerVendor']);
    Route::get('all_meals', [MealController::class, 'showMeal']);
    Route::get('mealsSearch/{id}', [MealController::class, 'searchMeal']);
    Route::post('singleMealsSearch', [MealController::class, 'fetchSingleMeal']);
    Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
    Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback']);
    Route::post('subscribe', [UserController::class, 'subscribeToNewsletter']);
    Route::post('unsubscribe', [UserController::class, 'unsubscribeToNewsletter']);
    Route::post('forgot-password', [UserController::class, 'unsubscribeToNewsletter']);
});
