<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/auth/login', [AuthController::class, 'login']); 
Route::post('/auth/register', [AuthController::class, 'register']); 
Route::post('/auth/logout', [AuthController::class, 'logout']); 

Route::middleware(['check.sanctum.token', 'auth:sanctum'])->group(function(){
    Route::get('/products', [ProductController::class, 'index']); 
    Route::get('/products/{id}', [ProductController::class, 'show']); //melihat data
    Route::post('/products', [ProductController::class, 'store']); //membuat data
    Route::put('/products/{id}', [ProductController::class, 'update']); //update data
    Route::delete('/products/{id}', [ProductController::class, 'destroy']); //hapus data
    Route::post('/auth/logout', [AuthController::class, 'logout']);
}); 

