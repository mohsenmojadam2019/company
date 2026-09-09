<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('website')) return back()->with('success', 'درخواست شما با موفقیت دریافت شد.');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:160'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);
        return back()->with('success', 'درخواست شما با موفقیت دریافت شد. به‌زودی با شما تماس می‌گیریم.');
    }
}
