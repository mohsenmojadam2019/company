@extends('layouts.site')
@section('meta_title','خدمات — '.($siteSettings['site_name'] ?? config('app.name')))
@section('meta_description','خدمات طراحی، مدیریت پروژه، ساخت برج لوکس، ویلا و معماری داخلی آریا سازه.')
@section('content')
<section class="simple-hero"><div class="lux-container simple-hero-grid"><div><span class="gold-kicker">از ایده تا تحویل</span><h1>خدمات یکپارچه برای ساخت پروژه‌های ماندگار.</h1><p>طراحی، مدیریت و اجرا در یک تیم هماهنگ؛ با مسئولیت روشن در تمام مراحل پروژه.</p></div><img src="{{ asset('assets/construction/hero-tower.svg') }}" alt="برج لوکس آریا سازه" width="1600" height="900" fetchpriority="high"></div></section>
<section class="section"><div class="lux-container"><div class="services-large-grid">@forelse($services as $service)<a class="service-large-card reveal" href="{{ route('services.show',$service) }}"><span>{{ $service->eyebrow }}</span><h2>{{ $service->title }}</h2><p>{{ $service->short_description }}</p><b>مشاهده خدمت ←</b></a>@empty<div class="empty-state">خدمتی ثبت نشده است.</div>@endforelse</div><div class="pagination-wrap">{{ $services->links() }}</div></div></section>
@endsection
