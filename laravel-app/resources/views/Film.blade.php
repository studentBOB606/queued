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

<div class="hero-space"></div>

<main class="films-page">

    {{-- Filter bar --}}
    <form method="GET" action="/films" class="films-filter-bar">
        <input type="hidden" name="genre" value="{{ $activeGenre }}">
        <div class="genre-pills">
            <a href="/films" class="genre-pill {{ !$activeGenre ? 'active' : '' }}">All</a>
            @foreach([28=>'Action',35=>'Comedy',27=>'Horror',878=>'Sci-Fi',18=>'Drama',12=>'Adventure',16=>'Animation',80=>'Crime',10749=>'Romance',53=>'Thriller'] as $id => $name)
                <a href="/films?genre={{ $id }}&sort={{ $activeSort }}" class="genre-pill {{ $activeGenre === $id ? 'active' : '' }}">{{ $name }}</a>
            @endforeach
        </div>
        <select name="sort" class="films-sort" onchange="this.form.submit()">
            <option value="popularity.desc" {{ $activeSort === 'popularity.desc' ? 'selected' : '' }}>Most Popular</option>
            <option value="vote_average.desc" {{ $activeSort === 'vote_average.desc' ? 'selected' : '' }}>Top Rated</option>
            <option value="release_date.desc" {{ $activeSort === 'release_date.desc' ? 'selected' : '' }}>Latest</option>
            <option value="revenue.desc" {{ $activeSort === 'revenue.desc' ? 'selected' : '' }}>Highest Grossing</option>
        </select>
    </form>

    @if($activeGenre || count($filteredFilms))
        {{-- Filtered results --}}
        <section class="film-section">
            <div class="section-header">
                <h2>Results</h2>
                <span class="search-count">{{ count($filteredFilms) }} films</span>
            </div>
            <div class="film-row">
                @forelse($filteredFilms as $film)
                    <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="film-card">
                        @if(!empty($film['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                        @else
                            <div class="film-placeholder"><span>{{ $film['title'] }}</span></div>
                        @endif
                    </a>
                @empty
                    <p class="empty-message">No films found.</p>
                @endforelse
            </div>
        </section>
    @else

    <section class="film-section">
        <div class="section-header">
            <h2>Trending</h2>
            <a href="#">More</a>
        </div>

        <div class="film-row">
            @foreach($trendingFilms as $film)
                <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="film-card">
                    @if(!empty($film['poster_path']))
                        <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                    @else
                        <div class="film-placeholder">
                            <span>{{ $film['title'] }}</span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </section>

    <section class="film-section">
        <div class="section-header">
            <h2>Popular</h2>
            <a href="#">More</a>
        </div>

        <div class="film-row">
            @foreach($popularFilms as $film)
                <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="film-card">
                    @if(!empty($film['poster_path']))
                        <img src="https://image.tmdb.org/t/p/w500{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                    @else
                        <div class="film-placeholder">
                            <span>{{ $film['title'] }}</span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </section>
    @endif

</main>

</body>
</html>
