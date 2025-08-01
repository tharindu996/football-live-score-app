@extends("components.layouts.base")
@section("title")
    Home
@endsection

@section("content")
    <div class="grid-container">
        <div class="">
            @if ($ongoingFootballMatch)
                <div class="border border-2 py-3 px-4 rounded text-center">
                    <h1>Live Football Score</h1>
                    <div class="">

                        Connection Status : <span id="connection-status"></span>
                    </div>
                    <div>
                        <h2>Live Score</h2>
                        <p id="score" class="fw-bold">
                            {{ $ongoingFootballMatch->homeTeam->title }}(H)
                            <span id="home-score">0</span>
                            - <span id="away-score">0</span>
                            {{ $ongoingFootballMatch->awayTeam->title }}(A)
                        </p>
                    </div>
                </div>
            @else
                <div class="">
                    No ongoing match is found.
                </div>
            @endif
        </div>
    </div>
@endsection
