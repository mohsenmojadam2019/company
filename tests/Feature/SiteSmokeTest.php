<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render(): void
    {
        foreach (['/', '/about', '/services', '/projects', '/insights', '/contact', '/robots.txt', '/sitemap.xml'] as $uri) {
            $this->get($uri)->assertSuccessful();
        }
    }

    public function test_contact_form_stores_an_enquiry(): void
    {
        $this->post('/contact', [
            'name' => 'Taylor Smith',
            'email' => 'taylor@example.com',
            'company' => 'Example Co',
            'subject' => 'New project',
            'message' => 'We need help with a new corporate website project.',
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseHas(ContactMessage::class, ['email' => 'taylor@example.com']);
    }

    public function test_admin_requires_an_admin_account(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');

        $user = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'secret-password',
            'is_admin' => true,
        ]);

        $this->actingAs($user)->get('/admin')->assertSuccessful();
    }
}
