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
            <li><a href="/login">Sign In</a></li>
            <li><a href="/films">Films</a></li>
            <li><a href="/list">List</a></li>
        </ul>
        <div class="nav-search">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" placeholder="Search films...">
        </div>
    </nav>

    <section class="hero">
        <div class="hero-backdrop"></div>

        <div class="hero-content">
            <a class="hero-eyebrow">Your personal film journal</a>
            <h1 class="hero-title">Track every film you've ever watched.</h1>
            <p class="hero-subtitle">Rate, review, and discover films with Queued — built for people who take cinema seriously.</p>
            <a href="/register" class="btn-primary">Get started</a>
            <p class="hero-subtitle1">The social network for film lovers.</p>
        </div>
    </section>



</body>
</html>