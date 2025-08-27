<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
