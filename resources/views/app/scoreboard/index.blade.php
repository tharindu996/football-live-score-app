{{-- <form action="{{ route("football-match.update-score", ["football_match" => 1,"team" => 1]) }}" method="post">
    @csrf
    <button>A</button>
</form> --}}

@extends("components.layouts.base")

@section("content")
    <div class="row justify-content-center">

        <div class="col-12 col-md-6">

            @if ($ongoingFootballMatch)
                
           
            <h2>
                Scoreboard Form
            </h2>
            <div class="table-wrapper">
                <table class="table table">
                    <tbody>
                        <tr>
                            <th>{{ $ongoingFootballMatch->homeTeam->title }}</th>
                            <td>
                                <form class=""
                                    action="{{ route("football-match.update-score", ["football_match" => $ongoingFootballMatch->id, "team" => $ongoingFootballMatch->homeTeam->id]) }}"
                                    method="post">
                                    @csrf
                                    @method("patch")
                                    <button type="submit" class="btn btn-primary">Score</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ $ongoingFootballMatch->awayTeam->title }}</th>
                            <td>
                                <form class=""
                                    action="{{ route("football-match.update-score", ["football_match" => $ongoingFootballMatch->id, "team" => $ongoingFootballMatch->awayTeam->id]) }}"
                                    method="post">
                                    @csrf
                                    @method("patch")
                                    <button type="submit" class="btn btn-primary">Score</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ $ongoingFootballMatch->awayTeam->title }}</th>
                            <td>
                                <form class=""
                                    action="{{ route("football-match.update-status", ["football_match" => $ongoingFootballMatch]) }}"
                                    method="post">
                                    @csrf
                                    @method("patch")
                                    <select id="status" name="status" class="form-select">
                                        <option selected disabled>Choose match status</option>
                                        @forelse ($matchStatus as $value => $label)
                                            <option value="{{ $value }}" {{ $ongoingFootballMatch->status->value === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @empty
                                            <option selected disabled>No match status found</option>
                                        @endforelse
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update {{ $ongoingFootballMatch->status  }}</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
                <div class="text-center my-4">
                    <h4>No match is going on.</h4>
                </div>
             @endif
        </div>
    </div>
@endsection
