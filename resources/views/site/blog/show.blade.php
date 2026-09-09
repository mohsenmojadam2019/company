@extends('layouts.site')
@section('meta_title',$post->seo_title ?: $post->title.' — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description',$post->seo_description ?: $post->excerpt)
@section('content')
<section class="article-hero"><div class="lux-container article-shell"><span class="gold-kicker">مجله آریا سازه</span><h1>{{ $post->title }}</h1><p>{{ $post->excerpt }}</p><div class="article-meta"><span>{{ $post->published_at?->format('Y/m/d') }}</span><span>زمان مطالعه: ۵ دقیقه</span></div></div></section>
<section class="article-cover"><div class="lux-container"><img src="{{ \App\Support\Media::url($post->image,'assets/construction/hero-tower.svg') }}" alt="{{ $post->title }}" width="1600" height="900" fetchpriority="high"></div></section>
<section class="section"><article class="lux-container article-body"><div class="prose">{!! nl2br(e($post->body)) !!}</div><aside><span class="gold-kicker">آریا سازه</span><p>برای بررسی پروژه ساختمانی خود می‌توانید با تیم مشاوره ما در ارتباط باشید.</p><a class="gold-btn" href="{{ route('contact') }}">درخواست مشاوره ←</a></aside></article></section>
@endsection
