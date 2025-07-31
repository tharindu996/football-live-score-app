<?php

namespace App\Http\Controllers;

use App\Enums\FootballMatchStatus;
use App\Events\MatchFinished;
use App\Events\ScoreUpdated;
use App\Models\FootballMatch;
use App\Http\Requests\StoreFootballMatchRequest;
use App\Http\Requests\UpdateFootballMatchStatusRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class FootballMatchController extends Controller
{
    /**
     * update match status.
     */
    public function updateStatus(UpdateFootballMatchStatusRequest $request, FootballMatch $footballMatch)
    {

        try {
            $inputs = $request->validated();
            $footballMatch->update(['status' => $inputs['status'],]);
            session(['status' => $inputs['status']]);

            if ($inputs['status'] === 'finished') {
                session()->forget(['teamA', 'teamB', 'status']);
                MatchFinished::dispatch($footballMatch->id);
            }

            ScoreUpdated::dispatch(session('teamA'), session('teamB'));

            return redirect()->back()->with(['success' => 'Football match status is updated']);
        } catch (Exception $e) {
            Log::error('Error updating football match status: ' . $e->getMessage(), [
                'match_id' => $footballMatch->id,
                'status_attempted' => $request->input('status'),
                'exception' => $e
            ]);

            return redirect()->back()->with(['error' => 'Failed to update football match status. Please try again.']);
        }
    }

    /**
     * update match score.
     */
    public function updateScore(Request $request, FootballMatch $footballMatch, Team $team)
    {
        try {

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
        } catch (Exception $e) {

            return redirect()->back()->with(['error' => 'Failed to update football match score. Please try again.']);
        }
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
        try {
            $inputs = $request->validated();
            $ongoingMatchCount = FootballMatch::whereNot('status', FootballMatchStatus::FINISHED)->count();
            if ($ongoingMatchCount > 0) {
                return redirect()->back()->with(['errors' => 'Can not create a match when there is a ongoing match.']);
            }

            $match = FootballMatch::create([...$inputs, 'status' => FootballMatchStatus::ONGOING]);

            return redirect()->back()->with(['success' => 'Football match is created successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Failed to create match. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FootballMatch $footballMatch)
    {
        try {
            $footballMatch->delete();
            return redirect()->back()->with(['success' => 'Football match is deleted successfully']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Failed to delete match. Please try again.']);
        }
    }
}
