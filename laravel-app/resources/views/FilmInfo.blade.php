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
        <div class="nav-search">
            <input type="text" placeholder="Search films...">
        </div>

        <div class="profile-circle">Y</div>
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
                <button class="watch-button">Add to list</button>
            </div>
        </div>

    </section>

</main>

</body>
</html>
