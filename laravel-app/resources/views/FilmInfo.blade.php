<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $film['title'] ?? 'Film' }} - Queued</title>

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

<main class="film-info-page">

    <section class="film-info-wrapper">

        <div class="film-info-poster-box">
            @if(!empty($film['poster_path']))
                <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
            @else
                <div class="film-info-placeholder">
                    {{ $film['title'] ?? 'No poster' }}
                </div>
            @endif
        </div>

        <div class="film-info-card">
            <h1>{{ $film['title'] ?? 'Unknown title' }}</h1>

            <div class="film-rating">
                @php
                    $rating = $film['vote_average'] ?? 0;
                    $stars = round($rating / 2);
                @endphp

                @for ($i = 1; $i <= 5; $i++)
                    @if($i <= $stars)
                        ★
                    @else
                        ☆
                    @endif
                @endfor

                <span>{{ number_format($rating, 1) }}/10</span>
            </div>

            <p class="film-description">
                {{ $film['overview'] ?? 'No description available.' }}
            </p>

            <div class="film-details-grid">
                <div>
                    <span>Release date</span>
                    <strong>{{ $film['release_date'] ?? 'Unknown' }}</strong>
                </div>

                <div>
                    <span>Duration</span>
                    <strong>{{ $film['runtime'] ?? 'Unknown' }} min</strong>
                </div>

                <div>
                    <span>Genre</span>
                    <strong>
                        @if(!empty($film['genres']))
                            {{ collect($film['genres'])->pluck('name')->join(', ') }}
                        @else
                            Unknown
                        @endif
                    </strong>
                </div>

                <div>
                    <span>Language</span>
                    <strong>{{ strtoupper($film['original_language'] ?? 'Unknown') }}</strong>
                </div>
            </div>

            <div class="film-actions">
                <a href="{{ route('films.index') }}" class="back-button">Back to films</a>
                @auth
                    @if(session('added'))
                        <span class="list-feedback">✓ Added to your list</span>
                    @else
                        <form method="POST" action="/list" style="display:inline;">
                            @csrf
                            <input type="hidden" name="tmdb_id" value="{{ $film['id'] }}">
                            <input type="hidden" name="title" value="{{ $film['title'] }}">
                            <input type="hidden" name="poster_path" value="{{ $film['poster_path'] ?? '' }}">
                            <button type="submit" class="watch-button">Add to list</button>
                        </form>
                    @endif
                @else
                    <a href="/login" class="watch-button">Sign in to add</a>
                @endauth
            </div>
        </div>

    </section>

</main>

</body>
</html>
