<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track films you've watched. Save films you want to see. Queued.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Queued</title>
    @vite(['resources/css/app.css'])
</head>
<body>

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

    <section class="hero">
        <div class="hero-backdrop"></div>

        <div class="hero-content">
            <p class="hero-eyebrow">Your personal film journal</p>
            <h1 class="hero-title">Track every film you've ever watched.</h1>
            <p class="hero-subtitle">Rate, review, and discover films with Queued — built for people who take cinema seriously.</p>
            <a href="/register" class="btn-primary">Get started</a>
            <p class="hero-subtitle1">The social network for film lovers.</p>
        </div>
    </section>

    <main class="films-page">

        <section class="film-section">
            <div class="section-header">
                <h2>Trending</h2>
                <a href="/films">Trending films</a>
            </div>
            <div class="film-row">
                @forelse($trendingFilms as $film)
                    <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="film-card">
                        @if(!empty($film['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w300{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                        @else
                            <div class="film-placeholder"><span>{{ $film['title'] }}</span></div>
                        @endif
                    </a>
                @empty
                    <p class="empty-message">No trending films.</p>
                @endforelse
            </div>
        </section>

        <section class="film-section">
            <div class="section-header">
                <h2>Popular</h2>
                <a href="/films">Popular films</a>
            </div>
            <div class="film-row">
                @forelse($popularFilms as $film)
                    <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="film-card">
                        @if(!empty($film['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w300{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                        @else
                            <div class="film-placeholder"><span>{{ $film['title'] }}</span></div>
                        @endif
                    </a>
                @empty
                    <p class="empty-message">No popular films.</p>
                @endforelse
            </div>
        </section>

        <section class="film-section">
            <div class="section-header">
                <h2>Upcoming</h2>
                <a href="/films">Upcoming Films</a>
            </div>
            <div class="upcoming-row">
                @forelse($upcomingFilms as $film)
                    <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="upcoming-card">
                        @if(!empty($film['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w400{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                        @else
                            <div class="film-placeholder"><span>{{ $film['title'] }}</span></div>
                        @endif
                        <div class="upcoming-info">
                            <span class="upcoming-title">{{ $film['title'] }}</span>
                            <span class="upcoming-date">{{ \Carbon\Carbon::parse($film['release_date'])->format('M j, Y') }}</span>
                        </div>
                    </a>
                @empty
                    <p class="empty-message">No upcoming films.</p>
                @endforelse
            </div>
        </section>

    </main>

</body>
</html>
