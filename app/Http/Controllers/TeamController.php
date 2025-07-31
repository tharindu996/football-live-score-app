<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Exception;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderBy('id', 'desc')->paginate(5);
        return view('app.teams.index', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        try {
            $inputs = $request->validated();
            Team::create($inputs);
            toast('Team added successfully','success');
            return redirect()->back()->with(['success' => 'Team added successfully']);
        } catch (Exception $e) {
            toast('Failed to create a team. Please try again.','error');
            return redirect()->back()->with(['error' => 'Failed to create a team. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
            toast('Team deleted successfully','success');

            return redirect()->back()->with(['success' => 'Team deleted successfully']);
        } catch (Exception $e) {

            return redirect()->back()->with(['error' => 'Failed to delete team. Please try again.']);
        }
    }
}
