@extends("components.layouts.base")
@section("content")
    <div class="form-wrapper my-2 my-md-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h2>
                    Match Form
                </h2>
                <form class="row g-3 mt-3" action="{{ route("football-matches.store") }}" method="post">
                    @csrf
                    @method("post")
                    <div class="col-md-4">
                        <label for="home-team" class="form-label">Home team</label>
                        <select id="home-team" name="home_team_id" class="form-select">
                            <option selected disabled>Choose home team</option>
                            @forelse ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->title }}</option>
                            @empty
                                <option selected disabled>No teams found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="away-team" class="form-label">Away team</label>
                        <select id="away-team" name="away_team_id" class="form-select">
                            <option selected disabled>Choose away team</option>
                            @forelse ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->title }}</option>
                            @empty
                                <option selected disabled>No teams found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Match ID</th>
                <th>Home team</th>
                <th>Away team</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse ($footballMatches as $key => $footballMatch)
                    <tr>
                        <td>{{ $key + $footballMatches->firstItem() }}</td>
                        <td>{{ $footballMatch->id }}</td>
                        <td>{{ $footballMatch->homeTeam->title }}</td>
                        <td>{{ $footballMatch->awayTeam->title }}</td>
                        <td>{{ $footballMatch->status }}</td>
                        <td>
                            <form action="{{ route("football-matches.destroy", $footballMatch) }}" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No football matches found.</td>
                    </tr>
                @endforelse
                {{ $footballMatches->links() }}
            </tbody>
        </table>
    </div>
@endsection
