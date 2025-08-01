<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FootballMatchController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\TeamController;

Route::get('/', [BaseController::class, 'index'])->name('index');
Route::resource('teams', TeamController::class)->only(['index', 'store', 'destroy']);
Route::patch('/football-matches/{football_match}/update-score/{team}', [FootballMatchController::class, 'updateScore'])->name('football-match.update-score');
Route::patch('/football-matches/{football_match}/update-status', [FootballMatchController::class, 'updateStatus'])->name('football-match.update-status');
Route::resource('football-matches', FootballMatchController::class)->only(['index', 'store', 'destroy']);
Route::get('/scoreboard', [ScoreboardController::class, 'index']);

