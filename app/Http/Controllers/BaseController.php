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
        $ongoingFootballMatch = FootballMatch::where('status', FootballMatchStatus::ONGOING)->count();
       
        return view('app.index', compact('ongoingFootballMatch'));
    }
}
