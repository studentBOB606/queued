<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track films you've watched. Save films you want to see. Queued.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Queued - Films</title>

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

    <div class="nav-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>

        <input type="text" placeholder="Search films...">
    </div>
</nav>

<div class="hero-space"></div>

<main class="films-page">

    <section class="film-section">
        <div class="section-header">
            <h2>Trending</h2>
            <a href="#">More</a>
        </div>

        <div class="film-row">
            @forelse($trendingFilms as $film)
                <div class="film-card">
                    @if($film->poster)
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}">
                    @else
                        <div class="film-placeholder">
                            <span>{{ $film->title }}</span>
                        </div>
                    @endif
                </div>
            @empty
                <p class="empty-message">No trending films yet.</p>
            @endforelse
        </div>
    </section>

    <section class="film-section">
        <div class="section-header">
            <h2>Popular</h2>
            <a href="#">More</a>
        </div>

        <div class="film-row">
            @forelse($popularFilms as $film)
                <div class="film-card">
                    @if($film->poster)
                        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}">
                    @else
                        <div class="film-placeholder">
                            <span>{{ $film->title }}</span>
                        </div>
                    @endif
                </div>
            @empty
                <p class="empty-message">No popular films yet.</p>
            @endforelse
        </div>
    </section>

</main>

</body>
</html>
