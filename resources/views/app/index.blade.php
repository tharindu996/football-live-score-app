@extends("components.layouts.base")

@section("content")
    @if (empty($ongoingFootballMatch))
        <h1>Live Football Score</h1>
        <div id="connection-status"></div>
        <div>
            <h2>Live Score</h2>
            <p id="score">Team A 0 - 0 Team B</p>
        </div>
    @else
        <div class="">
            No ongoing match is found.
        </div>
    @endif
@endsection
