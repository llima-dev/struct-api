<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'store']);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);
