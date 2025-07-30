<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::paginate(5);
        return view('app.teams.index', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $inputs = $request->validated();
        Team::create($inputs);
        return redirect()->back()->with(['success' => 'Team added successfully']);
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('app.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $inputs = $request->validated();        
        $team->update($inputs);
        return redirect()->back()->with(['success' => 'Team updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->back()->with(['success' => 'Team deleted successfully']);
    }
}
