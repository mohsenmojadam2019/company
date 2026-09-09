@extends('layouts.site')
@section('meta_title', 'Services — '.($siteSettings['site_name'] ?? config('app.name')))
@section('content')
<section class="page-hero section-pad"><div class="container narrow-wide"><span class="eyebrow">Capabilities</span><h1>Specialist services that connect into one system.</h1><p>Choose a focused engagement or combine capabilities into a complete company, brand and digital transformation.</p></div></section>
<section class="section-pad soft-section"><div class="container"><div class="service-grid service-grid-large">@foreach($services as $service)<a class="service-card" href="{{ route('services.show',$service) }}"><span class="service-index">{{ $service->eyebrow ?: str_pad((string)$loop->iteration,2,'0',STR_PAD_LEFT) }}</span><h3>{{ $service->title }}</h3><p>{{ $service->short_description }}</p><span class="circle-arrow">↗</span></a>@endforeach</div>{{ $services->links() }}</div></section>
@endsection
