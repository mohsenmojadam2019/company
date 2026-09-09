<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $metaTitle = trim($__env->yieldContent('meta_title')) ?: ($siteSettings['seo_title'] ?? $siteSettings['site_name'] ?? config('app.name'));
        $metaDescription = trim($__env->yieldContent('meta_description')) ?: ($siteSettings['seo_description'] ?? $siteSettings['site_tagline'] ?? 'Modern corporate website.');
    @endphp
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="theme-color" content="#ffffff">
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $siteSettings['site_name'] ?? config('app.name'),
        'url' => url('/'),
        'email' => $siteSettings['email'] ?? null,
        'telephone' => $siteSettings['phone'] ?? null,
    ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header" data-header>
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="Home">
            <span class="brand-mark" aria-hidden="true">N</span>
            <span>{{ $siteSettings['site_name'] ?? 'Northstar Studio' }}</span>
        </a>
        <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false" data-menu-toggle>
            <span></span><span></span>
        </button>
        <nav class="main-nav" data-menu>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
            <a href="{{ route('services.index') }}" @class(['active' => request()->routeIs('services.*')])>Services</a>
            <a href="{{ route('projects.index') }}" @class(['active' => request()->routeIs('projects.*')])>Work</a>
            <a href="{{ route('blog.index') }}" @class(['active' => request()->routeIs('blog.*')])>Insights</a>
            <a class="nav-cta" href="{{ route('contact') }}">Start a project <span>↗</span></a>
        </nav>
    </div>
</header>
<main id="main">@yield('content')</main>
<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a class="brand brand-light" href="{{ route('home') }}"><span class="brand-mark">N</span><span>{{ $siteSettings['site_name'] ?? 'Northstar Studio' }}</span></a>
            <p class="footer-intro">{{ $siteSettings['site_tagline'] ?? 'Strategy, design and technology for ambitious companies.' }}</p>
        </div>
        <div><span class="footer-label">Explore</span><a href="{{ route('about') }}">About</a><a href="{{ route('services.index') }}">Services</a><a href="{{ route('projects.index') }}">Work</a><a href="{{ route('blog.index') }}">Insights</a></div>
        <div><span class="footer-label">Contact</span>@if($siteSettings['email'] ?? null)<a href="mailto:{{ $siteSettings['email'] }}">{{ $siteSettings['email'] }}</a>@endif @if($siteSettings['phone'] ?? null)<a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">{{ $siteSettings['phone'] }}</a>@endif <a href="{{ route('contact') }}">Send an enquiry</a></div>
    </div>
    <div class="container footer-bottom"><span>© {{ date('Y') }} {{ $siteSettings['site_name'] ?? config('app.name') }}</span><span>Built with Laravel + Blade</span></div>
</footer>
@stack('scripts')
</body>
</html>
