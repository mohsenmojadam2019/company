<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view): void {
            $settings = [];

            if (Schema::hasTable('settings')) {
                $settings = Setting::query()->pluck('value', 'key')->all();
            }

            $view->with('siteSettings', $settings);
        });
    }
}
