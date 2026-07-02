<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track films you've watched. Save films you want to see. Queued.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Queued</title>
    @vite(['resources/css/app.css'])
</head><body>

<nav>
    <a href="/" class="nav-logo">Queued</a>
    <ul class="nav-links">
        <li><a href="/login">Sign In</a></li>
        <li><a href="/films">Films</a></li>
        <li><a href="/list">List</a></li>
    </ul>
    <div class="nav-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" placeholder="Search films...">
    </div>
</nav>

<main class="login-page">
    <div class="login-container">
        <h1 class="login-title">Create Account</h1>
        <p class="login-sub">Join Queued and start tracking films.</p>

        @if ($errors->any())
            <div class="login-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/register" class="login-form">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your name" required autofocus>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Min. 8 characters" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="login-btn">Sign Up</button>
        </form>

        <p class="login-footer">Already have an account? <a href="/login">Sign in</a></p>
    </div>
</main>

</body>
</html>
