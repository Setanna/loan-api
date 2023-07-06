<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MouseController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\LoanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Group to hold all protected routes */
Route::group(['middleware' => ['auth:sanctum']], function () {
    /* Get current user */
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /* Mouse controller */
    Route::apiResource('/mouse', MouseController::class);
    /* Laptop controller */
    Route::apiResource('/laptop', LaptopController::class);
    /* Loan controller */
    Route::apiResource('/loan', LoanController::class);
});

/* Unprotected Routes */

/* Auth Controller */
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');
