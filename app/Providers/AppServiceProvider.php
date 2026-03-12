<?php

namespace App\Providers;

use App\Models\Semester; 
use App\Observers\SemesterObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Semester::observe(SemesterObserver::class);
    }
}
