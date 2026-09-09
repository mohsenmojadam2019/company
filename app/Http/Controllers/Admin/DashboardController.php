<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'Services' => Service::query()->count(),
            'Projects' => Project::query()->count(),
            'Articles' => Post::query()->count(),
            'Unread messages' => ContactMessage::query()->where('is_read', false)->count(),
        ];

        $messages = ContactMessage::query()->latest()->limit(6)->get();

        return view('admin.dashboard', compact('stats', 'messages'));
    }
}
