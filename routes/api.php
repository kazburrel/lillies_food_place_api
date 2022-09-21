<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MealController;
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
Route::group(['middleware'=>['auth:admins']], function (){
    Route::post('meals', [MealController::class, 'storeMeal']);
    Route::post('logout', [AuthController::class, 'logout']);
    // Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    // Route::get('vendors', [VendorController::class, 'showVendor']);
});


// USERS 
Route::group(['middleware'=>['auth:sanctum','role:user']], function (){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('vendors', [VendorController::class, 'showVendor']);
    // Route::post('meals', [MealController::class, 'storeMeal']);
    // Route::get('users', [UserController::class, 'index']);
    // Route::get('users/{id}', [UserController::class, 'show']);
    // Route::get('vendors', [VendorController::class, 'showVendor']);
});

// VENDORS
Route::group(['middleware'=>['auth:sanctum', 'role:vendor']], function (){
    Route::get('users', [UserController::class, 'index']);
    Route::post('meals', [MealController::class, 'storeMeal']);
    Route::post('logout', [AuthController::class, 'logout']);
    // Route::get('users', [UserController::class, 'index']);
    // Route::get('users/{id}', [UserController::class, 'show']);
    // Route::get('vendors', [VendorController::class, 'showVendor']);
});


Route::post('users', [UserController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'authenticate']);
Route::post('vendors', [VendorController::class, 'registerVendor']);
Route::get('meals', [MealController::class, 'showMeal']);
Route::get('meals/{id}', [MealController::class, 'searchMeal']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
