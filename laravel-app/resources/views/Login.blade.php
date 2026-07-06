<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sign in to Queued — track films you've watched and save ones you want to see.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Sign In — Queued</title>
    @vite(['resources/css/app.css'])
</head>
<body>

<nav>
    <a href="/" class="nav-logo">Queued</a>
    <ul class="nav-links">
        <li><a href="/login">Sign In</a></li>
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

        {{-- Tab switcher --}}
        <div class="auth-tabs">
            <button class="auth-tab {{ session('_auth_form') !== 'signup' ? 'active' : '' }}" onclick="showTab('login')">Sign In</button>
            <button class="auth-tab {{ session('_auth_form') === 'signup' ? 'active' : '' }}" onclick="showTab('signup')">Sign Up</button>
        </div>

        @if ($errors->any())
            <div class="login-error">{{ $errors->first() }}</div>
        @endif

        {{-- Login form --}}
        <div id="tab-login" class="auth-panel {{ session('_auth_form') === 'signup' ? 'hidden' : '' }}">
            <form method="POST" action="/login" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="login-btn">Log In</button>
            </form>
        </div>

        {{-- Signup form --}}
        <div id="tab-signup" class="auth-panel {{ session('_auth_form') !== 'signup' ? 'hidden' : '' }}">
            <form method="POST" action="/register" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="signup-name">Name</label>
                    <input type="text" id="signup-name" name="name" value="{{ old('name') }}" placeholder="Your name" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">Email</label>
                    <input type="email" id="signup-email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input type="password" id="signup-password" name="password" placeholder="Min. 8 characters" required>
                </div>
                <div class="form-group">
                    <label for="signup-password-confirm">Confirm Password</label>
                    <input type="password" id="signup-password-confirm" name="password_confirmation" placeholder="Repeat password" required>
                </div>
                <button type="submit" class="login-btn">Create Account</button>
            </form>
        </div>

    </div>
</main>

<script>
function showTab(tab) {
    document.getElementById('tab-login').classList.toggle('hidden', tab !== 'login');
    document.getElementById('tab-signup').classList.toggle('hidden', tab !== 'signup');
    document.querySelectorAll('.auth-tab').forEach((btn, i) => {
        btn.classList.toggle('active', (i === 0 && tab === 'login') || (i === 1 && tab === 'signup'));
    });
}

// If there are validation errors, stay on the correct tab
@if ($errors->has('name') || $errors->has('password_confirmation'))
    showTab('signup');
@endif
</script>

</body>
</html>
