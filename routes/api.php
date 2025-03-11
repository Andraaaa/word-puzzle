<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameResultsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('/game', GameController::class)->only(['show', 'store' , 'update']);

    Route::resource('/submission', SubmissionController::class)->only(['store']);

    Route::resource('/leaderboard', LeaderboardController::class)->only('index');
    Route::get('/game/{gameId}/result', GameResultsController::class);
});

