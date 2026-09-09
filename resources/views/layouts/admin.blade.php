<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title', 'Admin') · {{ $siteSettings['site_name'] ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
<div class="admin-shell">
    <aside class="admin-sidebar">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}"><span class="brand-mark">N</span><div><strong>{{ $siteSettings['site_name'] ?? 'Northstar' }}</strong><small>Administration</small></div></a>
        <nav class="admin-nav">
            <span class="admin-nav-label">Overview</span>
            <a href="{{ route('admin.dashboard') }}" @class(['active' => request()->routeIs('admin.dashboard')])><span>◫</span> Dashboard</a>
            <span class="admin-nav-label">Content</span>
            @foreach(config('cms.resources') as $key => $resourceConfig)
                <a href="{{ route('admin.cms.index', $key) }}" @class(['active' => request()->is('admin/content/'.$key.'*')])><span>○</span> {{ $resourceConfig['title'] }}</a>
            @endforeach
            <span class="admin-nav-label">Operations</span>
            <a href="{{ route('admin.messages.index') }}" @class(['active' => request()->routeIs('admin.messages.*')])><span>✉</span> Messages</a>
            <a href="{{ route('admin.settings.edit') }}" @class(['active' => request()->routeIs('admin.settings.*')])><span>⚙</span> Settings</a>
        </nav>
        <div class="admin-sidebar-foot"><a href="{{ route('home') }}" target="_blank">View website ↗</a><form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit">Sign out</button></form></div>
    </aside>
    <main class="admin-main">
        <header class="admin-topbar"><div><span class="admin-kicker">Workspace</span><h1>@yield('page_heading', 'Dashboard')</h1></div><div class="admin-user"><span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span><div><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->email }}</small></div></div></header>
        <div class="admin-content">
            @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert error"><strong>Please review the form.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
