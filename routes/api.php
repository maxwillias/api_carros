<?php

use App\Http\Controllers\Api\CarroController;
use Illuminate\Support\Facades\Route;

Route::apiResource('cars', CarroController::class);
