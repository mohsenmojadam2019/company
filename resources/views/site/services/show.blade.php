@extends('layouts.site')
@section('meta_title',$service->seo_title ?: $service->title.' — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description',$service->seo_description ?: $service->short_description)
@section('content')
<section class="simple-hero"><div class="lux-container simple-hero-grid"><div><span class="gold-kicker">{{ $service->eyebrow }}</span><h1>{{ $service->title }}</h1><p>{{ $service->short_description }}</p><a class="gold-btn" href="{{ route('contact') }}">درخواست مشاوره ←</a></div><img src="{{ asset($service->icon === 'building' ? 'assets/construction/hero-tower.svg' : 'assets/construction/hero-villa.svg') }}" alt="{{ $service->title }}" width="1600" height="900" fetchpriority="high"></div></section>
<section class="section"><div class="lux-container detail-info-grid"><aside class="project-facts"><span class="gold-kicker">مسیر همکاری</span><div><small>مرحله ۱</small><strong>بررسی و مشاوره</strong></div><div><small>مرحله ۲</small><strong>طراحی و برنامه</strong></div><div><small>مرحله ۳</small><strong>اجرا و کنترل</strong></div><div><small>مرحله ۴</small><strong>تحویل نهایی</strong></div></aside><article class="project-story"><span class="gold-kicker">جزئیات خدمت</span><h2>یک فرآیند حرفه‌ای، شفاف و قابل کنترل.</h2><div class="prose">{!! nl2br(e($service->body)) !!}</div></article></div></section>
@endsection
