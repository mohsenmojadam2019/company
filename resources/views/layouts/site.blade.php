<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $metaTitle = trim($__env->yieldContent('meta_title')) ?: ($siteSettings['seo_title'] ?? $siteSettings['site_name'] ?? config('app.name'));
        $metaDescription = trim($__env->yieldContent('meta_description')) ?: ($siteSettings['seo_description'] ?? $siteSettings['site_tagline'] ?? 'طراحی و ساخت پروژه‌های ساختمانی لوکس.');
    @endphp
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <meta name="theme-color" content="#ffffff">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="preload" as="image" href="{{ asset('assets/construction/hero-tower.svg') }}" fetchpriority="high">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org','@type'=>'GeneralContractor','name'=>$siteSettings['site_name'] ?? config('app.name'),'url'=>url('/'),'email'=>$siteSettings['email'] ?? null,'telephone'=>$siteSettings['phone'] ?? null,'address'=>$siteSettings['address'] ?? null], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="site-body">
<a class="skip-link" href="#main">رفتن به محتوای اصلی</a>
<div class="cursor-dot" data-cursor-dot aria-hidden="true"></div><div class="cursor-ring" data-cursor-ring aria-hidden="true"></div>
<header class="site-header" data-header><div class="lux-container header-inner">
    <a class="site-brand" href="{{ route('home') }}" aria-label="{{ $siteSettings['site_name'] ?? 'آریا سازه' }}"><img src="{{ asset('assets/construction/logo.svg') }}" alt="" width="168" height="52"></a>
    <button class="menu-toggle" type="button" aria-label="باز کردن منو" aria-expanded="false" data-menu-toggle><span></span><span></span></button>
    <nav class="main-nav" data-menu aria-label="منوی اصلی">
        <a href="{{ route('home') }}" @class(['active'=>request()->routeIs('home')])>صفحه اصلی</a>
        <a href="{{ route('projects.index') }}" @class(['active'=>request()->routeIs('projects.*')])>پروژه‌ها</a>
        <a href="{{ route('services.index') }}" @class(['active'=>request()->routeIs('services.*')])>خدمات</a>
        <a href="{{ route('about') }}" @class(['active'=>request()->routeIs('about')])>درباره ما</a>
        <a href="{{ route('blog.index') }}" @class(['active'=>request()->routeIs('blog.*')])>وبلاگ</a>
        <a href="{{ route('contact') }}" @class(['active'=>request()->routeIs('contact')])>تماس با ما</a>
    </nav>
    <a class="gold-btn header-cta" href="{{ route('contact') }}">درخواست مشاوره <span>←</span></a>
</div></header>
<main id="main">@yield('content')</main>
<footer class="site-footer"><div class="lux-container footer-main">
    <div class="footer-brand"><img src="{{ asset('assets/construction/logo.svg') }}" alt="{{ $siteSettings['site_name'] ?? 'آریا سازه' }}" width="190" height="58"><p>{{ $siteSettings['site_tagline'] ?? 'خانه‌ها و برج‌هایی برای نسل‌های آینده.' }}</p></div>
    <div class="footer-col"><strong>دسترسی سریع</strong><a href="{{ route('projects.index') }}">پروژه‌ها</a><a href="{{ route('services.index') }}">خدمات</a><a href="{{ route('about') }}">درباره ما</a><a href="{{ route('blog.index') }}">وبلاگ</a></div>
    <div class="footer-col"><strong>ارتباط با ما</strong>@if($siteSettings['phone'] ?? null)<a href="tel:{{ preg_replace('/\s+/', '', $siteSettings['phone']) }}">{{ $siteSettings['phone'] }}</a>@endif @if($siteSettings['email'] ?? null)<a href="mailto:{{ $siteSettings['email'] }}">{{ $siteSettings['email'] }}</a>@endif @if($siteSettings['address'] ?? null)<span>{{ $siteSettings['address'] }}</span>@endif</div>
    <div class="footer-news"><strong>همراه آریا سازه</strong><p>برای شروع پروژه یا دریافت مشاوره با ما در ارتباط باشید.</p><a class="outline-btn" href="{{ route('contact') }}">شروع گفتگو</a></div>
</div><div class="lux-container footer-bottom"><span>© {{ date('Y') }} {{ $siteSettings['site_name'] ?? config('app.name') }}</span><span>Laravel 13 · Blade · PHP 8.4</span></div></footer>
@stack('scripts')
</body>
</html>
