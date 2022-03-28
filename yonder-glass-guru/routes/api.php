<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FitmentQuotationController;
use App\Http\Controllers\AuthController;

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

Route::post('signin', [AuthController::class, 'signin']);
Route::post('signup', [AuthController::class, 'signup']);
Route::middleware('auth:api')->group(function () {
    Route::post('quotation/response', [FitmentQuotationController::class, 'quotation_response']);
    Route::post('quotation/request', [FitmentQuotationController::class, 'quotation_request']);
    
});