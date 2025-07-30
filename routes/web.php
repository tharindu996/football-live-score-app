<?php

use Illuminate\Support\Facades\Route;
use App\Events\ScoreUpdated;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FootballMatchController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TeamController;

Route::get('/', [BaseController::class, 'index']);
Route::resource('teams', TeamController::class)->except(['create', 'show']);
Route::resource('football-matches', FootballMatchController::class)->only(['index', 'store', 'destroy']);

// Route::post('/goal/{team}', function ($team) {
//     // Simulate score increment (use session or DB in real app)
//     $teamA = session('teamA', 0);
//     $teamB = session('teamB', 0);    

//     if ($team === 'A') {
//         $teamA++;
//     } else {
//         $teamB++;
//     }
//     session(['teamA' => $teamA, 'teamB' => $teamB]);

//     ScoreUpdated::dispatch($teamA, $teamB);
//     return response()->json(['message' => 'Goal recorded!']);
// })->name('goal');



Route::get('/live-score', function () {
    return view('live-score');
});

Route::get('/score', function () {
    return view('score');
});
