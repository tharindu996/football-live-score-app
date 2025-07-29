<form action="{{ route('goal', ['team' => 'A']) }}" method="post">
    @csrf
    <button>A</button>
</form>