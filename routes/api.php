<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IPAddressController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', RegistrationController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {

    Route::resource('ip', IPAddressController::class)->except('show', 'update');
    Route::get('ip/{ip_address}', [IPAddressController::class, 'show']);
    Route::put('ip/{ip_address}', [IPAddressController::class, 'update']);
});
