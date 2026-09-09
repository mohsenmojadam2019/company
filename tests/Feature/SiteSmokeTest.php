<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_with_rtl_and_seo_metadata(): void
    {
        foreach (['/', '/about', '/services', '/projects', '/insights', '/contact'] as $uri) {
            $response = $this->get($uri)->assertSuccessful();
            $response
                ->assertSee('dir="rtl"', false)
                ->assertSee('<meta name="description"', false)
                ->assertSee('<link rel="canonical"', false)
                ->assertSee('assets/css/app.css')
                ->assertSee('assets/js/app.js');
        }

        $this->get('/')
            ->assertSee('ساخته شده توسط تیم فنی')
            ->assertSee('redcoweb.ir');

        $this->get('/projects?category='.urlencode('ویلاهای لوکس'))
            ->assertSuccessful()
            ->assertSee('content="noindex,follow', false);

        $this->get('/robots.txt')->assertSuccessful()->assertSee('Disallow: /admin');
        $this->get('/sitemap.xml')->assertSuccessful();
    }

    public function test_static_frontend_assets_are_available(): void
    {
        $this->assertFileExists(public_path('assets/css/app.css'));
        $this->assertFileExists(public_path('assets/js/app.js'));
    }

    public function test_contact_form_stores_an_enquiry(): void
    {
        $this->post('/contact', [
            'name' => 'علی رضایی',
            'email' => 'ali@example.com',
            'phone' => '09120000000',
            'company' => 'Example',
            'subject' => 'ساخت ویلا',
            'message' => 'برای ساخت یک ویلای لوکس نیاز به مشاوره دارم.',
        ])->assertSessionHasNoErrors()->assertSessionHas('success');

        $this->assertDatabaseHas(ContactMessage::class, [
            'email' => 'ali@example.com',
            'subject' => 'ساخت ویلا',
        ]);
    }

    public function test_projects_can_be_filtered_by_category(): void
    {
        Project::query()->create([
            'title' => 'ویلای تست',
            'category' => 'ویلاهای لوکس',
            'location' => 'لواسان',
            'status' => 'در حال اجرا',
            'is_active' => true,
        ]);

        Project::query()->create([
            'title' => 'برج تست',
            'category' => 'برج‌های مسکونی',
            'location' => 'تهران',
            'status' => 'در حال اجرا',
            'is_active' => true,
        ]);

        $this->get('/projects?category='.urlencode('ویلاهای لوکس'))
            ->assertSuccessful()
            ->assertSee('ویلای تست')
            ->assertDontSee('برج تست');
    }

    public function test_admin_requires_an_admin_account(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');

        $user = User::query()->create([
            'name' => 'مدیر',
            'email' => 'admin@example.com',
            'password' => 'secret-password',
            'is_admin' => true,
        ]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertSuccessful()
            ->assertSee('داشبورد')
            ->assertSee('assets/css/app.css')
            ->assertSee('assets/js/app.js');
    }
}
