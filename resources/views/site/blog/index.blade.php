@extends('layouts.site')
@section('meta_title', 'Insights — '.($siteSettings['site_name'] ?? config('app.name')))
@section('content')
<section class="page-hero section-pad"><div class="container narrow-wide"><span class="eyebrow">Insights</span><h1>Ideas for clearer decisions and better systems.</h1><p>Notes on strategy, corporate design, digital products, operations and growth.</p></div></section>
<section class="section-pad soft-section"><div class="container"><div class="insight-grid insight-grid-large">@foreach($posts as $post)<a class="insight-card" href="{{ route('blog.show',$post) }}"><span>{{ $post->published_at?->format('M d, Y') }}</span><h3>{{ $post->title }}</h3><p>{{ $post->excerpt }}</p><b>Read article →</b></a>@endforeach</div>{{ $posts->links() }}</div></section>
@endsection
