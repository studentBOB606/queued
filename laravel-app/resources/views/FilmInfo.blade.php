<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $film->title }} - Queued</title>

    @vite(['resources/css/app.css'])
</head>

<body>

<nav>
    <a href="/" class="nav-logo">Queued</a>

    <ul class="nav-links">
        <li><a href="/films">Films</a></li>
        <li><a href="/list">List</a></li>
    </ul>

    <div class="nav-search">
        <input type="text" placeholder="Search films...">
    </div>

    <div class="profile-circle">Y</div>
</nav>

<main class="film-info-page">

    <section class="film-info-wrapper">

        <div class="film-info-poster-box">
            @if($film->poster)
                <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}">
            @else
                <div class="film-info-placeholder">
                    {{ $film->title }}
                </div>
            @endif
        </div>

        <div class="film-info-card">
            <h1>{{ $film->title }}</h1>

            <div class="film-rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if($film->rating && $i <= round($film->rating / 2))
                        ★
                    @else
                        ☆
                    @endif
                @endfor

                <span>{{ $film->rating ?? 'No rating' }}/10</span>
            </div>

            <p class="film-description">
                {{ $film->description }}
            </p>

            <div class="film-details-grid">
                <div>
                    <span>Release year</span>
                    <strong>{{ $film->release_year }}</strong>
                </div>

                <div>
                    <span>Genre</span>
                    <strong>{{ $film->genre ?? 'Unknown' }}</strong>
                </div>

                <div>
                    <span>Duration</span>
                    <strong>{{ $film->duration }} min</strong>
                </div>

            </div>

            <div class="film-actions">
                <a href="/films" class="back-button">Back to films</a>
                <button class="watch-button">Add to list</button>
            </div>
        </div>

    </section>

</main>

</body>
</html>
