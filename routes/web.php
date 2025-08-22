<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AikidoDemoController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta principal para la demo de aikido.dev
Route::get('/aikido-demo', function () {
    return view('aikido-demo');
});

// Rutas para los endpoints de la demo de aikido.dev
Route::prefix('aikido-demo')->group(function () {
    Route::get('/basic-errors', [AikidoDemoController::class, 'basicErrors']);
    Route::post('/validation-errors', [AikidoDemoController::class, 'validationErrors']);
    Route::get('/database-errors', [AikidoDemoController::class, 'databaseErrors']);
    Route::get('/auth-errors', [AikidoDemoController::class, 'authErrors']);
    Route::post('/file-errors', [AikidoDemoController::class, 'fileErrors']);
    Route::get('/performance-errors', [AikidoDemoController::class, 'performanceErrors']);
    Route::post('/security-errors', [AikidoDemoController::class, 'securityErrors']);
});
