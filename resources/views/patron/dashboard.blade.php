<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patrons</title>
</head>
<body>
    @if(Auth::check())
    <h1>Welcome {{ Auth::user()->username }}</h1>
    @else
        <h1>You are not logged in</h1>
    @endif

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>