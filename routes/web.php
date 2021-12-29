<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
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

Route::get('/', function() {
    return view('welcome');
});

Route::prefix('/users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
    Route::get('add', [UserController::class, 'create'])->name('users.add');
    Route::post('add', [UserController::class, 'store'])->name('users.store');
    Route::get('{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('destroy', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('/companies')->group(function() {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('add', [CompanyController::class, 'create'])->name('companies.add');
    Route::post('add', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('{company}/users/add', [CompanyController::class, 'companyUsersIndex'])->name('companies.users.add');
    Route::post('{company}/users/add', [CompanyController::class, 'companyUsersStore'])->name('companies.users.add');
    Route::get('{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('{company}/edit', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');

});
