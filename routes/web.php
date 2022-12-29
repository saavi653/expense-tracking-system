<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {

    if(Auth::check())
    {
        return redirect()->route('user.dashboard');
    }
    return view('login');

})->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login.check');
Route::get('logout', [LogoutController ::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){

    Route::get('user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/expenses/create', [ExpenseController ::class, 'create'])->name('expenses.create');
    Route::get('categories/expenses/{expense:slug}/edit', [ExpenseController ::class, 'edit'])->name('expenses.edit');
    Route::post('categories/expenses/{expense}/update', [ExpenseController ::class, 'update'])->name('expenses.update');
    Route::post('categories/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('categories/expenses/show', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('categories/expenses/month-wise-expenses/show', [ExpenseController::class, 'monthWiseShow'])->name('categories.expenses.show');
});
