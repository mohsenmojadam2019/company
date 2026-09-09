@extends('layouts.site')
@section('meta_title', $service->seo_title ?: $service->title.' — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description', $service->seo_description ?: $service->short_description)
@section('content')
<section class="detail-hero section-pad"><div class="container detail-grid"><div><span class="eyebrow">{{ $service->eyebrow ?: 'Service' }}</span><h1>{{ $service->title }}</h1></div><div><p class="hero-lead">{{ $service->short_description }}</p><a class="btn btn-dark" href="{{ route('contact') }}">Discuss this service ↗</a></div></div></section>
<section class="section-pad soft-section"><div class="container detail-body"><div><span class="eyebrow">Overview</span></div><div class="prose"><p>{!! nl2br(e($service->body)) !!}</p></div></div></section>
<section class="cta-section"><div class="container cta-inner"><div><span class="eyebrow">Next step</span><h2>Need this capability in your company?</h2></div><a class="btn btn-dark" href="{{ route('contact') }}">Start a conversation ↗</a></div></section>
@endsection
