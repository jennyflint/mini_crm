<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\CompanyApiController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('get-companies', [CompanyApiController::class, 'getAllCompanies']);
    Route::get('get-clients/{company}', [CompanyApiController::class, 'getAllClients']);
    Route::get('get-client-companies/{client}', [ClientApiController::class, 'getClientCompanies']);
});
