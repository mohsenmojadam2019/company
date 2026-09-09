@extends('layouts.site')
@section('meta_title', 'Work — '.($siteSettings['site_name'] ?? config('app.name')))
@section('content')
<section class="page-hero section-pad"><div class="container narrow-wide"><span class="eyebrow">Selected work</span><h1>Projects shaped around real business outcomes.</h1><p>A mix of strategy, brand systems, corporate platforms and digital products across different sectors.</p></div></section>
<section class="section-pad"><div class="container"><div class="project-grid">@foreach($projects as $project)<a class="project-card" href="{{ route('projects.show',$project) }}"><div class="project-media">@if($project->image)<img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" loading="lazy" width="900" height="650">@else<span class="media-letter">{{ strtoupper(substr($project->title,0,1)) }}</span>@endif</div><div class="project-meta"><div><span>{{ $project->category ?: 'Project' }}</span><h3>{{ $project->title }}</h3></div><span class="circle-arrow">↗</span></div></a>@endforeach</div>{{ $projects->links() }}</div></section>
@endsection
