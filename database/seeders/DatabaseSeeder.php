<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD')) {
            User::query()->updateOrCreate(['email' => env('ADMIN_EMAIL')], [
                'name' => env('ADMIN_NAME', 'Administrator'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'is_admin' => true,
            ]);
        }

        foreach ([
            'site_name' => 'Northstar Studio', 'site_tagline' => 'Strategy, design and technology for ambitious companies.',
            'hero_title' => 'We build companies people remember.',
            'hero_text' => 'A flexible corporate platform for presenting services, capabilities, work and ideas with clarity.',
            'about_text' => 'We are a multidisciplinary company focused on useful strategy, thoughtful design and dependable delivery.',
            'email' => 'hello@example.com', 'phone' => '+1 555 010 2026', 'address' => 'Business District, Your City',
            'seo_title' => 'Northstar Studio — Corporate Strategy, Design & Technology',
            'seo_description' => 'A modern multi-purpose corporate website powered by Laravel and Blade.',
        ] as $key => $value) Setting::put($key, $value);

        if (Service::query()->doesntExist()) {
            collect([
                ['title' => 'Strategy & Advisory', 'eyebrow' => '01', 'short_description' => 'Clear direction for complex business decisions.', 'body' => 'We align market context, customer needs and operational reality into a practical roadmap.'],
                ['title' => 'Digital Products', 'eyebrow' => '02', 'short_description' => 'Web platforms designed around measurable outcomes.', 'body' => 'From discovery through launch, we create fast, accessible and maintainable digital products.'],
                ['title' => 'Brand Systems', 'eyebrow' => '03', 'short_description' => 'Identity systems that stay coherent as companies grow.', 'body' => 'Positioning, visual language, messaging and scalable brand standards for every customer touchpoint.'],
                ['title' => 'Growth Operations', 'eyebrow' => '04', 'short_description' => 'Sharper funnels, reporting and content operations.', 'body' => 'We improve the systems behind acquisition, conversion, retention and commercial reporting.'],
            ])->each(fn ($item, $index) => Service::query()->create($item + ['sort_order' => $index + 1, 'is_active' => true]));
        }

        if (Project::query()->doesntExist()) {
            collect([
                ['title' => 'Aster Finance Platform', 'category' => 'Digital Product', 'client' => 'Aster', 'short_description' => 'A clearer digital experience for a modern finance team.', 'body' => 'A complete discovery, UX and platform delivery engagement focused on trust, speed and conversion.'],
                ['title' => 'Meridian Industries', 'category' => 'Corporate Transformation', 'client' => 'Meridian', 'short_description' => 'Reframing a legacy industrial business for a new market.', 'body' => 'A corporate website and identity system designed to support international business development.'],
                ['title' => 'Nexa Health Network', 'category' => 'Brand & Web', 'client' => 'Nexa', 'short_description' => 'A scalable information architecture for a multi-location group.', 'body' => 'Service architecture, content system and digital design unified into one maintainable platform.'],
            ])->each(fn ($item, $index) => Project::query()->create($item + ['sort_order' => $index + 1, 'is_featured' => true, 'is_active' => true]));
        }

        if (TeamMember::query()->doesntExist()) {
            TeamMember::query()->create(['name' => 'Alex Morgan', 'role' => 'Managing Director', 'bio' => 'Strategy and operations lead.', 'sort_order' => 1, 'is_active' => true]);
            TeamMember::query()->create(['name' => 'Maya Chen', 'role' => 'Design Director', 'bio' => 'Brand and digital experience lead.', 'sort_order' => 2, 'is_active' => true]);
            TeamMember::query()->create(['name' => 'Daniel Park', 'role' => 'Technology Director', 'bio' => 'Engineering and platform architecture lead.', 'sort_order' => 3, 'is_active' => true]);
        }

        if (Testimonial::query()->doesntExist()) {
            Testimonial::query()->create(['name' => 'Jordan Lee', 'company' => 'Aster', 'quote' => 'The team turned a complicated brief into a simple, commercially useful product.', 'rating' => 5, 'sort_order' => 1, 'is_active' => true]);
            Testimonial::query()->create(['name' => 'Sam Rivera', 'company' => 'Meridian', 'quote' => 'Strong thinking, disciplined execution and a result our internal team can actually maintain.', 'rating' => 5, 'sort_order' => 2, 'is_active' => true]);
        }

        if (Post::query()->doesntExist()) {
            Post::query()->create(['title' => 'Designing a corporate site that earns trust', 'excerpt' => 'Five practical principles for clearer corporate communication.', 'body' => 'Trust comes from clarity, useful proof, strong hierarchy and a fast experience. Start with customer questions, then build the information architecture around decisions rather than internal departments.', 'published_at' => now(), 'is_active' => true]);
        }
    }
}
