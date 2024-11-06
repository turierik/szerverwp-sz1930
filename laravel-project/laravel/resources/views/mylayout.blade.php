<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogocska - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-3xl text-fuchsia-700 pb-8">Laravel Blog</h1>

        @auth
            <h2 class="text-xl">Szia, {{ Auth::user() -> name }}!</h2>
            Kijelentkezés
        @endauth

        @guest
            <a href="{{ route('login') }}">Bejelentkezés</a><br>
            <a href="{{ route('register') }}">Regisztráció</a><br>
        @endguest

        @yield('content')
    </div>
</body>
</html>
