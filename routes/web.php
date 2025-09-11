<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UrlController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::any('/s/{code}', [UrlController::class, 'redirect'])
    ->name('url.redirect-url');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [LoginController::class, 'index'])->name('/');
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'loginSubmit'])->name('admin.login.submit');

    Route::middleware(['auth:admin', 'prevent-back-button', 'check.module.permission'])->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // user
        Route::get('/user/all', [UserController::class, 'index'])
            ->name('admin.user.list');
        Route::get('/user/add', [UserController::class, 'create'])
            ->name('admin.user.add');
        Route::post('/user/add', [UserController::class, 'store'])
            ->name('admin.user.store');

        // urls
        Route::get('/url/all', [UrlController::class, 'index'])
            ->name('admin.url.list');
        Route::get('/url/add', [UrlController::class, 'create'])
            ->name('admin.url.add');
        Route::post('/url/add', [UrlController::class, 'store'])
            ->name('admin.url.store');
    });
});
