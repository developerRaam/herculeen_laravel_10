<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class EzServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with([
                'social' => DB::table('social_medias')->first(),
                'address' => DB::table('address')->first(),
                'setting' => DB::table('settings')->first(),
            ]);
        });
    }
}
