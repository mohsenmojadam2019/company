@extends('layouts.admin')
@section('title','Messages')
@section('page_heading','Messages')
@section('content')
<div class="admin-intro"><div><h2>Website enquiries</h2><p>Messages submitted through the public contact form.</p></div></div><section class="admin-card"><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Sender</th><th>Company</th><th>Subject</th><th>Status</th><th>Received</th><th></th></tr></thead><tbody>@forelse($messages as $message)<tr><td><strong>{{ $message->name }}</strong><small>{{ $message->email }}</small></td><td>{{ $message->company ?: '—' }}</td><td>{{ $message->subject ?: 'General enquiry' }}</td><td><span @class(['status-pill','is-live'=>$message->is_read,'is-draft'=>!$message->is_read])>{{ $message->is_read ? 'Read' : 'New' }}</span></td><td>{{ $message->created_at->format('M d, Y') }}</td><td><a class="row-link" href="{{ route('admin.messages.show',$message) }}">Open →</a></td></tr>@empty<tr><td colspan="6" class="empty-cell">No enquiries yet.</td></tr>@endforelse</tbody></table></div><div class="admin-pagination">{{ $messages->links() }}</div></section>
@endsection
