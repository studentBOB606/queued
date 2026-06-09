<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Track films you've watched. Save films you want to see. Queued.">
    <link rel="icon" type="image/png" href="/queued.png">
    <title>Queued</title>
</head>
<body>

    <nav>
        <a href="/" class="nav-logo">Queued</a>
        <ul class="nav-links">
            <li><a href="/login">Sign Up</a></li>
            <li><a href="/films">Films</a></li>
            <li><a href="/list">List</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-backdrop"></div>

        <div class="hero-content">
            <p class="hero-eyebrow">Your personal film journal</p>
            <h1 class="hero-title">Track every film you've ever watched.</h1>
            <p class="hero-subtitle">Rate, review, and discover films with Queued — built for people who take cinema seriously.</p>
            <a href="/register" class="btn-primary">Get started</a>
        </div>
    </section>

</body>
</html>