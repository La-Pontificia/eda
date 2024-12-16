<?php

use App\Http\Controllers\Api\Assist\AssistController;
use Illuminate\Support\Facades\Route;

Route::prefix('assists')->group(function () {
    Route::prefix('withoutUsers')->group(function () {
        Route::get('', [AssistController::class, 'withoutUsers']);
        Route::get('/report', [AssistController::class, 'withoutUsersReport']);
    });

    Route::prefix('withUsers')->group(function () {
        Route::get('', [AssistController::class, 'withUsers']);
        Route::get('/report', [AssistController::class, 'withUsersReport']);
    });
});
