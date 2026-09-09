<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()->latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->is_read) $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'پیام حذف شد.');
    }
}
