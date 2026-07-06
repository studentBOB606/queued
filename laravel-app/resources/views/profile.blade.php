<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your Queued profile.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Profile — Queued</title>
    @vite(['resources/css/app.css'])
</head>
<body>

<nav>
    <a href="/" class="nav-logo">Queued</a>
    <ul class="nav-links">
        @auth
            <li><a href="/profile">{{ Auth::user()->name }}</a></li>
            <li>
                <form method="POST" action="/logout" style="margin:0">
                    @csrf
                    <button type="submit" class="nav-logout">Sign Out</button>
                </form>
            </li>
        @else
            <li><a href="/login">Sign In</a></li>
        @endauth
        <li><a href="/films">Films</a></li>
        <li><a href="/list">List</a></li>
    </ul>
    <form class="nav-search" action="/search" method="GET">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" placeholder="Search films..." value="{{ request('q') }}" autocomplete="off">
    </form>
</nav>

<main class="login-page">
    <div class="login-container">
        <h1 class="login-title">{{ Auth::user()->name }}</h1>
        <p class="login-sub">{{ Auth::user()->email }}</p>
        <p class="login-sub">Member since {{ Auth::user()->created_at->format('F Y') }}</p>

        <form method="POST" action="/logout" style="margin-top: 1rem">
            @csrf
            <button type="submit" class="login-btn">Sign Out</button>
        </form>
    </div>
</main>

</body>
</html>
