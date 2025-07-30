<?php

namespace App\Http\Controllers;

use App\Enums\FootballMatchStatus;
use App\Models\FootballMatch;
use App\Http\Requests\StoreFootballMatchRequest;
use App\Http\Requests\UpdateFootballMatchRequest;

class FootballMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.football-matches.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFootballMatchRequest $request)
    {
        $inputs = $request->validated();
        $ongoingMatchCount = FootballMatch::where('status', FootballMatchStatus::ONGOING)->count();
        if($ongoingMatchCount > 0){
            return redirect()->back()->with(['errors' => 'Can not create a match when there is a ongoing match.']);
        }
        FootballMatch::create($inputs);
        return redirect()->back()->with(['success' => 'Football match is created successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FootballMatch $footballMatch)
    {
        $footballMatch->delete();
        return redirect()->back()->with(['success' => 'Football match is deleted successfully']);
    }
}
