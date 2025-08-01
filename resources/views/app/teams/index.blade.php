@extends("components.layouts.base")
@section("title")
    Teams
@endsection
@section("content")
    <div class="form-wrapper my-2 my-md-4">


        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h2>
                    Team Registration Form
                </h2>
                <form class="row g-3 mt-3" action="{{ route("teams.store") }}" method="post">
                    @csrf
                    @method("post")
                    <div class="col-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter team title">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <div class="table-wrapper">
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @forelse ($teams as $key => $team)
                    <tr>
                        <td>{{ $key + $teams->firstItem() }}</td>
                        <td>{{ $team->title }}</td>
                        <td>
                            <form action="{{ route("teams.destroy", $team) }}" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No teams found.</td>
                    </tr>
                @endforelse
                {{ $teams->links() }}
            </tbody>
        </table>
    </div>
@endsection
