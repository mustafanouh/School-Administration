<?php

namespace App\Providers;

use App\Models\Semester;
use App\Observers\SemesterObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Semester::observe(SemesterObserver::class);
    }
}
