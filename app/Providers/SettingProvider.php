<?php

namespace App\Providers;

use App\Models\Admin\Setting\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class SettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        /**
         * The pluck method can be used to retrieve values from a single column, and optionally, you can specify a key column to use as the array keys. Here’s a detailed explanation of how it works and how to use it:
         */

        $this->app->singleton('settings', function () {
            $settings = Setting::pluck('value', 'key')->toArray();
            return $settings;
        });

        /**
         * How can access data
         * app('settings')['site_name']
         */
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Fetch categories from cache or database
            $service_categories = DB::table('category')->where('status', true)->get();

            // Make categories available to all views
            $view->with('service_categories', $service_categories);
        });
    }
    
}
