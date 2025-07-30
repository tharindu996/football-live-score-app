<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreboardController extends Controller
{
    public function index()
    {
        return view('app.scoreboard.index');
    }
}
