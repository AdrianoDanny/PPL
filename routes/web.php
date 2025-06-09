<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GoatDiseaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\CustomerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'showHomepage']) -> name('homepage');

Route::get('/goat-disease', [GoatDiseaseController::class, 'index'])->name('goat.disease');
Route::post('/goat-disease', [GoatDiseaseController::class, 'diagnose'])->name('goat.diagnose');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// AJAX Route
Route::get('/kecamatan/{kabupaten}', [AuthController::class, 'getKecamatan']);

// Protected Routes with Role Middleware
Route::middleware(['auth:akun', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth:akun', 'role:pemasok'])->group(function () {
    Route::get('/pemasok/dashboard', [PemasokController::class, 'dashboard'])->name('pemasok.dashboard');
});

Route::middleware(['auth:akun', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

// routes/web.php - tambahkan route untuk kambing
Route::middleware(['auth:akun'])->group(function () {
    // Route khusus admin dan pemasok
    Route::middleware(['role:admin,pemasok'])->group(function () {
        Route::resource('kambing', KambingController::class);
    });
});
