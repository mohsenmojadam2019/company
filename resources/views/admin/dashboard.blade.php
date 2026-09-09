@extends('layouts.admin')
@section('title','Dashboard')
@section('page_heading','Dashboard')
@section('content')
<div class="admin-intro"><div><h2>Website overview</h2><p>A concise view of content and new enquiries.</p></div><a class="admin-btn" href="{{ route('admin.cms.create','projects') }}">+ New project</a></div>
<div class="stat-grid">@foreach($stats as $label => $value)<article class="stat-card"><span>{{ $label }}</span><strong>{{ $value }}</strong><small>Current total</small></article>@endforeach</div>
<section class="admin-card"><div class="admin-card-head"><div><h3>Recent messages</h3><p>Latest enquiries submitted through the website.</p></div><a href="{{ route('admin.messages.index') }}">View all →</a></div><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Name</th><th>Subject</th><th>Status</th><th>Received</th><th></th></tr></thead><tbody>@forelse($messages as $message)<tr><td><strong>{{ $message->name }}</strong><small>{{ $message->email }}</small></td><td>{{ $message->subject ?: 'General enquiry' }}</td><td><span @class(['status-pill','is-live'=>$message->is_read,'is-draft'=>!$message->is_read])>{{ $message->is_read ? 'Read' : 'New' }}</span></td><td>{{ $message->created_at->diffForHumans() }}</td><td><a class="row-link" href="{{ route('admin.messages.show',$message) }}">Open →</a></td></tr>@empty<tr><td colspan="5" class="empty-cell">No messages yet.</td></tr>@endforelse</tbody></table></div></section>
@endsection
