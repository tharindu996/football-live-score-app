<?php

namespace App\Http\Controllers;

use App\Enums\FootballMatchStatus;
use App\Models\FootballMatch;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BaseController extends Controller
{
    public function index()
    {
        $ongoingFootballMatch = FootballMatch::whereNot('status', FootballMatchStatus::FINISHED)->first();             
        return view('app.index', compact('ongoingFootballMatch'));
    }
}
