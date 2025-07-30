<?php

namespace App\Http\Controllers;

use App\Enums\FootballMatchStatus;
use App\Models\FootballMatch;

class ScoreboardController extends Controller
{
    public function index()
    {
        $ongoingFootballMatch = FootballMatch::where('status', FootballMatchStatus::ONGOING)->first();
        $matchStatus = FootballMatchStatus::toSelectArray();
        return view('app.scoreboard.index', compact('ongoingFootballMatch', 'matchStatus'));
    }
}
