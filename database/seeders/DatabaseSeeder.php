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
                'name' => env('ADMIN_NAME', 'مدیر سیستم'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'is_admin' => true,
            ]);
        }

        foreach ([
            'site_name' => 'آریا سازه',
            'site_tagline' => 'ساختن نه فقط شهر، بلکه زندگی بهتر',
            'hero_title' => 'ساخت برج‌های لوکس و خانه‌های رویایی',
            'hero_text' => 'ترکیبی از معماری معاصر، کیفیت ماندگار و دیدی متفاوت؛ برای ساختن خانه‌ها و برج‌هایی که سبک زندگی آینده را تعریف می‌کنند.',
            'about_text' => 'آریا سازه یک مجموعه تخصصی طراحی، مدیریت و اجرای پروژه‌های ساختمانی لوکس است. از انتخاب زمین و طراحی معماری تا ساخت، طراحی داخلی و تحویل نهایی، تمام مراحل با تمرکز بر کیفیت، جزئیات و ارزش پایدار مدیریت می‌شوند.',
            'email' => 'info@ariasazeh.com',
            'phone' => '021 2288 4455',
            'address' => 'تهران، خیابان شریعتی، دفتر مرکزی آریا سازه',
            'seo_title' => 'آریا سازه | ساخت برج‌های لوکس و ویلاهای مدرن',
            'seo_description' => 'طراحی، مدیریت و ساخت برج‌های مسکونی لوکس، ویلاهای مدرن و خانه‌های سفارشی با استانداردهای حرفه‌ای معماری و اجرا.',
        ] as $key => $value) Setting::put($key, $value);

        Service::query()->whereIn('title', ['Strategy & Advisory', 'Digital Products', 'Brand Systems', 'Growth Operations'])->delete();
        foreach ([
            ['title' => 'ساخت برج‌های لوکس', 'slug' => 'luxury-towers', 'eyebrow' => 'برج‌های مسکونی', 'icon' => 'building', 'short_description' => 'برج‌هایی ماندگار با معماری شاخص، امکانات کامل و اجرای دقیق.', 'body' => 'از مطالعات اولیه و طراحی تا مدیریت ساخت و تحویل، پروژه‌های مرتفع آریا سازه با تمرکز بر کیفیت سازه، جزئیات معماری، تاسیسات هوشمند و تجربه زندگی ممتاز اجرا می‌شوند.'],
            ['title' => 'ساخت ویلا', 'slug' => 'luxury-villas', 'eyebrow' => 'ویلاهای اختصاصی', 'icon' => 'home', 'short_description' => 'ویلاهای مدرن و سفارشی متناسب با زمین، سبک زندگی و سلیقه کارفرما.', 'body' => 'هر ویلا از صفر بر اساس ویژگی زمین، نور، منظر، خواسته‌های خانواده و بودجه طراحی می‌شود و تا آخرین جزئیات اجرا زیر نظر تیم پروژه باقی می‌ماند.'],
            ['title' => 'طراحی داخلی', 'slug' => 'interior-design', 'eyebrow' => 'فضاهای لوکس', 'icon' => 'interior', 'short_description' => 'طراحی فضاهای داخلی یکپارچه، گرم و ماندگار با متریال‌های ممتاز.', 'body' => 'معماری داخلی، نورپردازی، انتخاب متریال، مبلمان ثابت و جزئیات اجرایی در یک سیستم هماهنگ طراحی می‌شوند تا کیفیت نهایی پروژه در فضای داخلی ادامه پیدا کند.'],
            ['title' => 'مدیریت پروژه', 'slug' => 'project-management', 'eyebrow' => 'از برنامه تا تحویل', 'icon' => 'management', 'short_description' => 'برنامه‌ریزی، کنترل هزینه، مدیریت پیمانکاران و نظارت مستمر بر کیفیت.', 'body' => 'ساختار مدیریت پروژه آریا سازه شفاف و قابل پیگیری است؛ زمان‌بندی، بودجه، خرید، پیمانکاران و کنترل کیفیت با گزارش‌های منظم مدیریت می‌شوند.'],
            ['title' => 'مشاوره تخصصی', 'slug' => 'construction-advisory', 'eyebrow' => 'پیش از شروع ساخت', 'icon' => 'consulting', 'short_description' => 'تحلیل زمین، امکان‌سنجی، بودجه‌بندی و طراحی مسیر درست سرمایه‌گذاری.', 'body' => 'پیش از شروع پروژه، سناریوهای ساخت، ظرفیت زمین، بودجه، ریسک‌های اجرایی و ارزش نهایی پروژه تحلیل می‌شوند تا تصمیم‌ها بر پایه داده و تجربه گرفته شوند.'],
        ] as $index => $item) {
            Service::query()->updateOrCreate(['slug' => $item['slug']], $item + ['sort_order' => $index + 1, 'is_active' => true]);
        }

        Project::query()->whereIn('title', ['Aster Finance Platform', 'Meridian Industries', 'Nexa Health Network'])->delete();
        foreach ([
            ['title' => 'برج آریا رزیدنس', 'slug' => 'aria-residence', 'category' => 'برج‌های مسکونی', 'client' => 'سرمایه‌گذاری خصوصی', 'location' => 'زعفرانیه، تهران', 'status' => 'در حال اجرا', 'units' => 38, 'floors' => 24, 'area' => 24500, 'year' => '۱۴۰۶', 'image' => 'assets/construction/project-tower-01.svg', 'short_description' => 'برجی ۲۴ طبقه با دید پانورامیک، لابی مجلل و مجموعه کامل امکانات رفاهی.', 'body' => 'آریا رزیدنس با هدف خلق یک استاندارد تازه برای زندگی مرتفع در شمال تهران طراحی شده است. پلان‌های باز، تراس‌های عمیق، نمای ترکیبی سنگ و شیشه، لابی دو ارتفاع و امکانات اختصاصی از عناصر اصلی پروژه هستند.'],
            ['title' => 'ویلای لواسان', 'slug' => 'lavasan-villa', 'category' => 'ویلاهای لوکس', 'client' => 'کارفرمای خصوصی', 'location' => 'لواسان، تهران', 'status' => 'تکمیل شده', 'units' => 1, 'floors' => 3, 'area' => 1850, 'year' => '۱۴۰۵', 'image' => 'assets/construction/project-villa-01.svg', 'short_description' => 'ویلایی مینیمال با ارتباط پیوسته فضای داخلی، استخر و چشم‌انداز کوهستان.', 'body' => 'در این پروژه خط مرز داخل و بیرون تا حد ممکن حذف شده است. پنجره‌های سرتاسری، تراس‌های بزرگ، حیاط خصوصی و انتخاب متریال طبیعی، فضایی آرام و معاصر ایجاد کرده‌اند.'],
            ['title' => 'خانه سپید', 'slug' => 'white-house', 'category' => 'خانه‌های مدرن', 'client' => 'کارفرمای خصوصی', 'location' => 'فرمانیه، تهران', 'status' => 'تکمیل شده', 'units' => 1, 'floors' => 4, 'area' => 1320, 'year' => '۱۴۰۴', 'image' => 'assets/construction/project-villa-02.svg', 'short_description' => 'خانه‌ای شهری با هندسه خالص، نور طبیعی و حریم خصوصی کنترل‌شده.', 'body' => 'خانه سپید پاسخی به زندگی معاصر شهری است؛ نورگیری هوشمند، فضاهای خانوادگی باز و نمای آرام و خالص در کنار جزئیات دقیق اجرایی هویت پروژه را شکل داده‌اند.'],
            ['title' => 'مجتمع آریا پارک', 'slug' => 'aria-park', 'category' => 'برج‌های مسکونی', 'client' => 'آریا سرمایه', 'location' => 'شیراز', 'status' => 'مراحل پایانی', 'units' => 96, 'floors' => 18, 'area' => 36800, 'year' => '۱۴۰۶', 'image' => 'assets/construction/project-towers-02.svg', 'short_description' => 'مجموعه‌ای مسکونی با دو برج، فضای سبز مرکزی و امکانات خانوادگی کامل.', 'body' => 'آریا پارک به عنوان یک مجموعه مسکونی کامل طراحی شده؛ دو برج حول یک فضای سبز مرکزی سازماندهی شده‌اند و مسیرهای پیاده، باشگاه، استخر و فضاهای اجتماعی در قلب پروژه قرار گرفته‌اند.'],
            ['title' => 'ویلای آرمان', 'slug' => 'arman-villa', 'category' => 'ویلاهای لوکس', 'client' => 'کارفرمای خصوصی', 'location' => 'دریاکنار، نوشهر', 'status' => 'تکمیل شده', 'units' => 1, 'floors' => 2, 'area' => 980, 'year' => '۱۴۰۵', 'image' => 'assets/construction/project-villa-03.svg', 'short_description' => 'ویلای ساحلی با پلان باز، استخر روباز و معماری گرم و مینیمال.', 'body' => 'ویلای آرمان بر پایه زندگی در فضای باز طراحی شده است. نشیمن، تراس و استخر در یک محور قرار گرفته‌اند و متریال‌های گرم در کنار بتن روشن، شخصیت آرام پروژه را کامل می‌کنند.'],
            ['title' => 'برج آفاق', 'slug' => 'afagh-tower', 'category' => 'برج‌های مسکونی', 'client' => 'گروه سرمایه‌گذاری آفاق', 'location' => 'اصفهان', 'status' => 'در حال اجرا', 'units' => 64, 'floors' => 21, 'area' => 29100, 'year' => '۱۴۰۷', 'image' => 'assets/construction/project-tower-03.svg', 'short_description' => 'برج مسکونی شاخص با طراحی عمودی ظریف و واحدهای وسیع خانوادگی.', 'body' => 'برج آفاق با تاکید بر تناسبات عمودی، تراس‌های عمیق و سازماندهی واحدهای بزرگ طراحی شده است. هسته مرکزی فشرده، نورگیری چهار جهت و امکانات رفاهی کامل از ویژگی‌های اصلی پروژه‌اند.'],
        ] as $index => $item) {
            Project::query()->updateOrCreate(['slug' => $item['slug']], $item + ['sort_order' => $index + 1, 'is_featured' => true, 'is_active' => true]);
        }

        TeamMember::query()->whereIn('name', ['Alex Morgan', 'Maya Chen', 'Daniel Park'])->delete();
        foreach ([
            ['name' => 'محمد رضایی', 'role' => 'مدیرعامل و مدیر پروژه', 'bio' => 'بیش از ۱۵ سال تجربه در توسعه و مدیریت پروژه‌های ساختمانی لوکس.'],
            ['name' => 'سارا کریمی', 'role' => 'مدیر طراحی', 'bio' => 'معمار و طراح داخلی با تمرکز بر پروژه‌های مسکونی معاصر.'],
            ['name' => 'حسین نادری', 'role' => 'مدیر اجرا', 'bio' => 'متخصص برنامه‌ریزی اجرا، کنترل کیفیت و مدیریت پیمانکاران.'],
        ] as $index => $item) {
            TeamMember::query()->updateOrCreate(['name' => $item['name']], $item + ['sort_order' => $index + 1, 'is_active' => true]);
        }

        Testimonial::query()->whereIn('name', ['Jordan Lee', 'Sam Rivera'])->delete();
        foreach ([
            ['name' => 'دکتر محمد رضایی', 'company' => 'سرمایه‌گذار و کارفرما', 'quote' => 'همکاری با آریا سازه یکی از بهترین تجربه‌های ما بود؛ از طراحی تا اجرا، کیفیت و نظم در تمام مراحل کاملاً محسوس بود.', 'rating' => 5],
            ['name' => 'مهدی رضایی', 'company' => 'کارفرمای پروژه ویلایی', 'quote' => 'تیم آریا سازه ایده‌های ما را با جزئیات دقیق به یک خانه واقعی و بسیار باکیفیت تبدیل کرد.', 'rating' => 5],
        ] as $index => $item) {
            Testimonial::query()->updateOrCreate(['name' => $item['name']], $item + ['sort_order' => $index + 1, 'is_active' => true]);
        }

        Post::query()->where('title', 'Designing a corporate site that earns trust')->delete();
        foreach ([
            ['title' => 'آینده برج‌های مسکونی لوکس در ایران', 'slug' => 'future-luxury-residential-towers', 'excerpt' => 'چه عواملی یک برج مسکونی را از یک ساختمان مرتفع معمولی متمایز می‌کند؟', 'body' => 'برج لوکس فقط به متریال گران‌قیمت محدود نیست. کیفیت پلان، نور، دید، مدیریت تاسیسات، فضاهای مشترک و نگهداری بلندمدت باید از ابتدای طراحی در کنار یکدیگر دیده شوند.'],
            ['title' => 'طراحی داخلی لوکس؛ فراتر از زیبایی', 'slug' => 'luxury-interior-beyond-beauty', 'excerpt' => 'چرا کیفیت طراحی داخلی به اندازه معماری و سازه در ارزش نهایی پروژه اثر دارد؟', 'body' => 'فضای داخلی زمانی ماندگار می‌شود که عملکرد، نور، متریال و جزئیات اجرایی همزمان حل شوند. انتخاب‌های درست باید به یک زبان مشترک در کل پروژه تبدیل شوند.'],
            ['title' => 'راهنمای انتخاب زمین برای ساخت ویلای لوکس', 'slug' => 'land-selection-luxury-villa', 'excerpt' => 'دید، شیب، دسترسی و ضوابط؛ چهار عامل مهم پیش از خرید زمین برای ساخت ویلا.', 'body' => 'قبل از خرید زمین باید سناریوی ساخت بررسی شود. جهت نور، توپوگرافی، دسترسی، محدودیت‌های قانونی و هزینه آماده‌سازی زمین می‌توانند مستقیماً روی کیفیت و بودجه پروژه اثر بگذارند.'],
        ] as $index => $item) {
            Post::query()->updateOrCreate(['slug' => $item['slug']], $item + ['published_at' => now()->subDays($index * 8), 'is_active' => true]);
        }
    }
}
