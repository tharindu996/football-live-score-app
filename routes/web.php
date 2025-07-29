<?php

use Illuminate\Support\Facades\Route;
use App\Events\ScoreUpdated;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/goal/{team}', function ($team) {
    // Simulate score increment (use session or DB in real app)
    $teamA = session('teamA', 0);
    $teamB = session('teamB', 0);

    info($team);

    if ($team === 'A') {
        $teamA++;
    } else {
        $teamB++;
    }
    session(['teamA' => $teamA, 'teamB' => $teamB]);

    ScoreUpdated::dispatch($teamA, $teamB);
    return response()->json(['message' => 'Goal recorded!']);
})->name('goal');

Route::get('/live-score', function () {
    return view('live-score');
});

Route::get('/score', function () {
    return view('score');
});
