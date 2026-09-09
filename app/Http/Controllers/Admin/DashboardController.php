<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'پروژه‌های فعال' => Project::query()->where('is_active', true)->where('status', '!=', 'تکمیل شده')->count(),
            'برج‌های تکمیل شده' => Project::query()->where('status', 'تکمیل شده')->count(),
            'پروژه‌های ویلا' => Project::query()->where('category', 'like', '%ویلا%')->count(),
            'درخواست‌های جدید' => ContactMessage::query()->where('is_read', false)->count(),
            'کل سرنخ‌ها' => ContactMessage::query()->count(),
        ];

        $messages = ContactMessage::query()->latest()->limit(6)->get();
        $recentProjects = Project::query()->latest()->limit(4)->get();

        return view('admin.dashboard', compact('stats', 'messages', 'recentProjects'));
    }
}
