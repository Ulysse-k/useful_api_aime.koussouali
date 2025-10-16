<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/', function () {
//     return 'API';
// });

//Route::apiResource('modules', ModuleController::class);

Route::post('/register', [Authcontroller::class, 'register']);

Route::post('/login', [Authcontroller::class, 'login']);

//Route::post('/logout', [Authcontroller::class, 'logout'])->middleware('auth:sanctum');;

Route::get('/modules', [ModuleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('/modules/{id}/activate', [ModuleController::class, 'activate']);
    Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);
});

