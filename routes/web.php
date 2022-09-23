<?php

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
    // Route::post('meals', [MealController::class, 'storeMeal']);
    // Route::post('logout', [AuthController::class, 'logout']);
    // // Route::post('meals', [MealController::class, 'storeMeal']);
    // // Route::get('users', [UserController::class, 'index']);
    // Route::get('users', [UserController::class, 'index']);
    // Route::get('users/{id}', [UserController::class, 'show']);
    // Route::get('vendors', [VendorController::class, 'showVendor']);
    // Route::get('vendors/{id}', [VendorController::class, 'searchVendor']);
    // Route::get('admin/details', [AdminController::class, 'showAdminDetails']);
});
