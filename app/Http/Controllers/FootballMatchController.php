<?php

namespace App\Http\Controllers;

use App\Enums\FootballMatchStatus;
use App\Events\MatchFinished;
use App\Events\ScoreUpdated;
use App\Models\FootballMatch;
use App\Http\Requests\StoreFootballMatchRequest;
use App\Http\Requests\UpdateFootballMatchRequest;
use App\Http\Requests\UpdateFootballMatchStatusRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class FootballMatchController extends Controller
{
    /**
     * update match status.
     */
    public function updateStatus(UpdateFootballMatchStatusRequest $request, FootballMatch $footballMatch)
    {
        $inputs = $request->validated();       
        $footballMatch->update(['status' => $inputs['status'],]);
        session(['status' => $inputs['status']]);

        if($inputs['status'] === 'finished'){
           session()->forget(['teamA','teamB','status']);
           MatchFinished::dispatch($footballMatch->id);
        }

        ScoreUpdated::dispatch(session('teamA'), session('teamB'),  $inputs['status']);

        return redirect()->back()->with(['success' => 'Football match status is updated']);
    }

    /**
     * update match score.
     */
    public function updateScore(Request $request, FootballMatch $footballMatch, Team $team)
    {

        $teamA = session('teamA', $footballMatch->homeTeam->home_score);
        $teamB = session('teamB', $footballMatch->awayTeam->away_score);
       

        if ($team->id === $footballMatch->homeTeam->id) {
            $teamA++;
            $footballMatch->update(['home_score' => $teamA]);
        } else {
            $teamB++;
            $footballMatch->update(['away_score' => $teamB]);
        }
        session(['teamA' => $teamA, 'teamB' => $teamB]);
        
        ScoreUpdated::dispatch($teamA, $teamB);

        return redirect()->back()->with(['success' => 'Score updated successfully']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footballMatches = FootballMatch::orderBy('id', 'desc')->paginate(5);
        $teams = Team::all();
        return view('app.football-matches.index', compact('footballMatches', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFootballMatchRequest $request)
    {
        $inputs = $request->validated();
        $ongoingMatchCount = FootballMatch::whereNot('status', FootballMatchStatus::FINISHED)->count();
        if ($ongoingMatchCount > 0) {
            return redirect()->back()->with(['errors' => 'Can not create a match when there is a ongoing match.']);
        }

        $match = FootballMatch::create([...$inputs, 'status' => FootballMatchStatus::ONGOING]);
       
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
