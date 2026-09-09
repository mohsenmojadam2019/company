@extends('layouts.site')

@section('content')
<section class="hero section-pad">
    <div class="container hero-grid">
        <div class="hero-copy reveal">
            <span class="eyebrow">Independent company · Strategy / Design / Technology</span>
            <h1>{{ $siteSettings['hero_title'] ?? 'We build companies people remember.' }}</h1>
            <p class="hero-lead">{{ $siteSettings['hero_text'] ?? 'A flexible corporate platform for presenting services, capabilities, work and ideas with clarity.' }}</p>
            <div class="hero-actions"><a class="btn btn-dark" href="{{ route('contact') }}">Discuss a project <span>↗</span></a><a class="text-link" href="{{ route('projects.index') }}">View selected work <span>→</span></a></div>
        </div>
        <div class="hero-visual reveal" aria-hidden="true">
            <div class="hero-orbit orbit-one"></div><div class="hero-orbit orbit-two"></div><div class="hero-disc"><span>Clarity</span><strong>01</strong></div>
            <div class="hero-note note-a"><span>Strategy</span><b>Direction</b></div><div class="hero-note note-b"><span>Delivery</span><b>Systems</b></div>
        </div>
    </div>
    <div class="container metrics-row">
        <div><strong>12+</strong><span>Years combined experience</span></div><div><strong>42</strong><span>Projects shipped</span></div><div><strong>9</strong><span>Markets supported</span></div><div><strong>94%</strong><span>Repeat & referral work</span></div>
    </div>
</section>

<section class="section-pad soft-section">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">What we do</span><h2>One partner from direction to delivery.</h2></div><p>Modular services for companies that need sharper positioning, better digital products and dependable execution.</p></div>
        <div class="service-grid">
            @forelse($services as $service)
                <a class="service-card" href="{{ route('services.show', $service) }}"><span class="service-index">{{ $service->eyebrow ?: str_pad((string)$loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $service->title }}</h3><p>{{ $service->short_description }}</p><span class="circle-arrow">↗</span></a>
            @empty
                <div class="empty-state">Add services from the admin panel.</div>
            @endforelse
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">Selected work</span><h2>Proof, not promises.</h2></div><a class="text-link" href="{{ route('projects.index') }}">All projects <span>→</span></a></div>
        <div class="project-grid">
            @foreach($projects as $project)
                <a class="project-card" href="{{ route('projects.show', $project) }}">
                    <div class="project-media">@if($project->image)<img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" loading="lazy" width="900" height="650">@else<span class="media-letter">{{ strtoupper(substr($project->title,0,1)) }}</span>@endif</div>
                    <div class="project-meta"><div><span>{{ $project->category ?: 'Project' }}</span><h3>{{ $project->title }}</h3></div><span class="circle-arrow">↗</span></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section-pad dark-section">
    <div class="container process-grid">
        <div class="process-intro"><span class="eyebrow eyebrow-light">How we work</span><h2>Senior thinking. Small teams. Clear accountability.</h2><p>Every engagement is structured around decisions, evidence and measurable outcomes—not layers of process.</p></div>
        <div class="process-list"><div><span>01</span><div><h3>Understand</h3><p>Goals, users, constraints and commercial context.</p></div></div><div><span>02</span><div><h3>Define</h3><p>A focused roadmap with priorities and success measures.</p></div></div><div><span>03</span><div><h3>Build</h3><p>Fast, disciplined execution with visible progress.</p></div></div><div><span>04</span><div><h3>Improve</h3><p>Measure, learn and strengthen what performs.</p></div></div></div>
    </div>
</section>

@if($testimonials->isNotEmpty())
<section class="section-pad"><div class="container"><span class="eyebrow">Client perspective</span><div class="quote-grid">@foreach($testimonials->take(2) as $testimonial)<blockquote><div class="quote-mark">“</div><p>{{ $testimonial->quote }}</p><footer><strong>{{ $testimonial->name }}</strong><span>{{ $testimonial->company }}</span></footer></blockquote>@endforeach</div></div></section>
@endif

<section class="section-pad soft-section"><div class="container"><div class="section-heading"><div><span class="eyebrow">Insights</span><h2>Useful thinking for growing companies.</h2></div><a class="text-link" href="{{ route('blog.index') }}">Read all insights <span>→</span></a></div><div class="insight-grid">@foreach($posts as $post)<a class="insight-card" href="{{ route('blog.show',$post) }}"><span>{{ $post->published_at?->format('M d, Y') }}</span><h3>{{ $post->title }}</h3><p>{{ $post->excerpt }}</p><b>Read article →</b></a>@endforeach</div></div></section>

<section class="cta-section"><div class="container cta-inner"><div><span class="eyebrow">Have a project in mind?</span><h2>Let’s make the next move useful.</h2></div><a class="btn btn-dark" href="{{ route('contact') }}">Start a conversation <span>↗</span></a></div></section>
@endsection
