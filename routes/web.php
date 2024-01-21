<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Auth::routes(['register' => false, 'logout' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('is_admin')->prefix('admin')->group(function () {
    Route::resource('/companies', CompanyController::class);
    Route::resource('/employees', EmployeeController::class);
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
});
