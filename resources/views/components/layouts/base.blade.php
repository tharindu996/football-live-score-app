<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield("title") | {{ env("APP_NAME") }}</title>
    <meta name="author" content="Tharindu Dissanayake">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset("css/styles.css") }}">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    @vite(["resources/js/app.js"])

</head>

<body>
    <header>
        @include("components.includes.navbar")
    </header>

    <div class="main container">
        @include("sweetalert::alert")
        <div class="my-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @yield("content")
    </div>
    @include("components.includes.footer")

    <link rel="stylesheet" href="{{ asset("js/bootstrap.bundle.min.js") }}">
    @stack("scripts")
</body>

</html>
