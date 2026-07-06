<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password — Queued</title>
    <link rel="icon" type="image/png" href="/queued.png">
    @vite(['resources/css/app.css'])
</head>
<body>

<nav>
    <a href="/" class="nav-logo">Queued</a>
    <ul class="nav-links">
        <li><a href="/films">Films</a></li>
        <li><a href="/list">List</a></li>
    </ul>
    <form class="nav-search" action="/search" method="GET">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" placeholder="Search films..." autocomplete="off">
    </form>
</nav>

<main class="login-page">
    <div class="login-container">

        <h1 class="login-title">Forgot password</h1>
        <p class="login-sub">Enter your email and we'll send you a reset link.</p>

        @if(session('status'))
            <div class="login-success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="login-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/forgot-password" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
            </div>
            <button type="submit" class="login-btn">Send Reset Link</button>
        </form>

        <p class="login-footer"><a href="/login">Back to Sign In</a></p>

    </div>
</main>

</body>
</html>
