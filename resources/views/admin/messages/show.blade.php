@extends('layouts.admin')
@section('title','Message from '.$message->name)
@section('page_heading','Message')
@section('content')
<div class="admin-form-grid message-layout"><article class="admin-card message-card"><div class="message-head"><div class="message-avatar">{{ strtoupper(substr($message->name,0,1)) }}</div><div><h2>{{ $message->subject ?: 'General enquiry' }}</h2><p>From <strong>{{ $message->name }}</strong> · {{ $message->created_at->format('M d, Y · H:i') }}</p></div></div><div class="message-body">{!! nl2br(e($message->message)) !!}</div></article><aside class="admin-card contact-card"><span class="admin-kicker">Contact details</span><dl><dt>Email</dt><dd><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></dd><dt>Phone</dt><dd>{{ $message->phone ?: '—' }}</dd><dt>Company</dt><dd>{{ $message->company ?: '—' }}</dd></dl><a class="admin-btn full-btn" href="mailto:{{ $message->email }}">Reply by email ↗</a><form method="POST" action="{{ route('admin.messages.destroy',$message) }}" onsubmit="return confirm('Delete this message?')">@csrf @method('DELETE')<button class="danger-btn full-btn" type="submit">Delete message</button></form></aside></div>
@endsection
