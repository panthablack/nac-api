<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Auth Routes // *********************************************************************************

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());
    Route::get('/games', [GameController::class, 'index']);
    Route::get('/games/store', [GameController::class, 'store']);
    Route::get('/games/{game}', [GameController::class, 'show']);
    Route::get('/games/{game}/join', [GameController::class, 'join']);
});

// Public Routes // ********************************************************************************

// ...

// Guest Routes // *********************************************************************************

// ...
