<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Search results for {{ $q }} — Queued">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Queued - Search</title>
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
            <input type="text" name="q" placeholder="Search films..." value="{{ $q }}" autocomplete="off" autofocus>
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
            <h2>{{ $q ? 'Results for "' . $q . '"' : 'Search' }}</h2>
            <span class="search-count">{{ $results->count() }} {{ $results->count() === 1 ? 'film' : 'films' }}</span>
        </div>

        @if($results->isEmpty())
            <p class="empty-message" style="padding-top:2rem;">
                {{ $q ? 'No films found matching "' . $q . '".' : 'Enter a title to search.' }}
            </p>
        @else
            <div class="film-row">
                @foreach($results as $film)
                    <a href="{{ route('films.show', ['film' => $film['id']]) }}" class="film-card">
                        @if(!empty($film['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w300{{ $film['poster_path'] }}" alt="{{ $film['title'] }}">
                        @else
                            <div class="film-placeholder"><span>{{ $film['title'] }}</span></div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </section>

</main>

</body>
</html>
