@extends('layouts.site')
@section('meta_title', $project->seo_title ?: $project->title.' — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description', $project->seo_description ?: $project->short_description)
@section('content')
<section class="detail-hero section-pad"><div class="container"><span class="eyebrow">{{ $project->category ?: 'Case study' }}</span><h1 class="case-title">{{ $project->title }}</h1><p class="hero-lead max-text">{{ $project->short_description }}</p></div></section>
<div class="container"><div class="case-hero-media">@if($project->image)<img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" width="1500" height="850">@else<span>{{ strtoupper(substr($project->title,0,1)) }}</span>@endif</div></div>
<section class="section-pad"><div class="container detail-body"><aside class="case-facts"><div><span>Client</span><strong>{{ $project->client ?: 'Confidential' }}</strong></div><div><span>Category</span><strong>{{ $project->category ?: 'Corporate' }}</strong></div>@if($project->completed_at)<div><span>Completed</span><strong>{{ $project->completed_at->format('Y') }}</strong></div>@endif</aside><div class="prose"><h2>The work</h2><p>{!! nl2br(e($project->body)) !!}</p>@if($project->project_url)<p><a class="text-link" href="{{ $project->project_url }}" rel="noopener" target="_blank">Visit project ↗</a></p>@endif</div></div></section>
<section class="cta-section"><div class="container cta-inner"><div><span class="eyebrow">Your project</span><h2>Want a result built with the same discipline?</h2></div><a class="btn btn-dark" href="{{ route('contact') }}">Talk to us ↗</a></div></section>
@endsection
