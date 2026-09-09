@extends('layouts.site')
@section('meta_title','وبلاگ معماری و ساخت — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description','مقالات تخصصی آریا سازه درباره معماری، ساخت، ویلا، برج مسکونی، زمین و متریال.')
@section('content')
<section class="simple-hero"><div class="lux-container simple-hero-grid"><div><span class="gold-kicker">دانش و تجربه</span><h1>معماری، ساخت و سرمایه‌گذاری از نگاه آریا سازه.</h1><p>یادداشت‌هایی کاربردی درباره طراحی، ساخت، انتخاب زمین، متریال و کیفیت پروژه‌های مسکونی.</p></div><img src="{{ asset('assets/construction/admin-banner.svg') }}" alt="معماری مدرن" width="1200" height="420" fetchpriority="high"></div></section>
<section class="section"><div class="lux-container"><div class="blog-grid">@forelse($posts as $post)<a class="blog-card reveal" href="{{ route('blog.show',$post) }}"><div class="blog-card-art"><span>{{ str_pad((string)$loop->iteration,2,'0',STR_PAD_LEFT) }}</span></div><div><small>{{ $post->published_at?->format('Y/m/d') }}</small><h2>{{ $post->title }}</h2><p>{{ $post->excerpt }}</p><b>ادامه مطلب ←</b></div></a>@empty<div class="empty-state">هنوز مقاله‌ای منتشر نشده است.</div>@endforelse</div><div class="pagination-wrap">{{ $posts->links() }}</div></div></section>
@endsection
