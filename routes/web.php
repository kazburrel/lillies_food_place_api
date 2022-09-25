<?php

use App\Http\Controllers\AdminController;
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
    Route::delete('all_users/{user}', [AdminController::class, 'destroyUser'])->name('userDestroy');  
});
