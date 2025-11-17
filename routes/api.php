<?php

use App\Http\Controllers\MissionController;
use App\Http\Controllers\LeaderboardController;

Route::middleware('auth:sanctum')->group(function () {

    // ========== Missions ==========
    Route::post('/missions/update', [MissionController::class, 'updateDailyMissions']);
    Route::post('/missions/assign', [MissionController::class, 'assignDailyMissions']);
    Route::post('/missions/complete', [MissionController::class, 'completeMission']);

    // ========== Leaderboard ==========
    Route::get('/leaderboard/national', [LeaderboardController::class, 'national']);
    Route::get('/leaderboard/province/{province}', [LeaderboardController::class, 'province']);
    Route::get('/leaderboard/city/{city}', [LeaderboardController::class, 'city']);
});
