{{-- <form action="{{ route("football-match.update-score", ["football_match" => 1,"team" => 1]) }}" method="post">
    @csrf
    <button>A</button>
</form> --}}

@extends("components.layouts.base")

@section("content")
    <div class="row justify-content-center">

        <div class="col-12 col-md-6">
            <h2>
                Scoreboard Form
            </h2>
            <div class="d-flex">
                <form class="row g-3 mt-3" action="{{ route("football-match.update-score", ["football_match" => $ongoingFootballMatch->id ,"team" => $ongoingFootballMatch->homeTeam->id]) }}" method="post">
                    @csrf
                    @method("patch")
                    
                    <div class="col-6">
                        <div class="fw-bold">{{ $ongoingFootballMatch->homeTeam->title }}</div>
                        <button type="submit" class="btn btn-primary">Score</button>
                    </div>
                </form>

                <form class="row g-3 mt-3" action="" method="post">
                    @csrf
                    @method("post")
                    <div class="col-6">
                        <div class="fw-bold">{{ $ongoingFootballMatch->awayTeam->title }}</div>
                        <button type="submit" class="btn btn-primary">Score</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
