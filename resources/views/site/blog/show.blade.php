@extends('layouts.site')
@section('meta_title', $post->seo_title ?: $post->title.' — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description', $post->seo_description ?: $post->excerpt)
@section('content')
<article><header class="article-header section-pad"><div class="container article-narrow"><span class="eyebrow">Insight · {{ $post->published_at?->format('M d, Y') }}</span><h1>{{ $post->title }}</h1><p class="hero-lead">{{ $post->excerpt }}</p></div></header>@if($post->image)<div class="container article-image"><img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" width="1400" height="760"></div>@endif<section class="section-pad"><div class="container article-narrow prose article-prose"><p>{!! nl2br(e($post->body)) !!}</p></div></section></article>
<section class="cta-section"><div class="container cta-inner"><div><span class="eyebrow">Need a practical partner?</span><h2>Turn the thinking into shipped work.</h2></div><a class="btn btn-dark" href="{{ route('contact') }}">Start a conversation ↗</a></div></section>
@endsection
