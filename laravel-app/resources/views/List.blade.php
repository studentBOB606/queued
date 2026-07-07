<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track films you've watched. Save films you want to see. Queued.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Queued - My List</title>
    @vite(['resources/css/app.css'])
</head><body>

<nav>
    <a href="/" class="nav-logo">Queued</a>
    <ul class="nav-links">
        <li><a href="/films">Films</a></li>
        <li><a href="/list">List</a></li>
    </ul>
    <div class="nav-right">
        <form class="nav-search" action="/search" method="GET">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="q" placeholder="Search films..." value="{{ request('q') }}" autocomplete="off">
        </form>
        @auth
            <div class="nav-profile-wrap">
                <a href="/profile" class="nav-avatar" title="{{ Auth::user()->name }}">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </a>
                <div class="nav-profile-dropdown">
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                    <a href="/profile">Profile</a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit">Sign Out</button>
                    </form>
                </div>
            </div>
        @else
            <a href="/login" class="nav-signin">Sign In</a>
        @endauth
    </div>
</nav>

<main class="films-page">

    <section class="film-section">
        <div class="section-header">
            <h2>My List</h2>
            @auth
                <span class="search-count">{{ $films->count() }} {{ $films->count() === 1 ? 'film' : 'films' }}</span>
            @endauth
        </div>

        @guest
            <p class="empty-message" style="padding-top:2rem;">
                <a href="/login" style="color:#9333ea;">Sign in</a> to save films to your list.
            </p>
        @else
            @if($films->isEmpty())
                <p class="empty-message" style="padding-top:2rem;">No films in your list yet. Browse <a href="/films" style="color:#9333ea;">Films</a> to add some.</p>
            @else
                <div class="film-row">
                    @foreach($films as $film)
                        <a href="{{ route('films.show', ['film' => $film->tmdb_id]) }}" class="film-card" style="position:relative;">
                            @if($film->poster_path)
                                <img src="https://image.tmdb.org/t/p/w300{{ $film->poster_path }}" alt="{{ $film->title }}">
                            @else
                                <div class="film-placeholder"><span>{{ $film->title }}</span></div>
                            @endif
                            <form method="POST" action="/list/{{ $film->tmdb_id }}" style="position:absolute;top:6px;right:6px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="list-remove-btn" title="Remove">✕</button>
                            </form>
                        </a>
                    @endforeach
                </div>
            @endif
        @endguest
    </section>

</main>

</body>
</html>
