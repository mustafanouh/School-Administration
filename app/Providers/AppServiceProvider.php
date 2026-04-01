<?php

namespace App\Providers;

use Livewire\Volt\Volt;
use App\Models\Semester;
use App\Observers\SemesterObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
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
        Route::pattern('id', '[0-9]+');
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
        
        // Volt::mount([
        //     resource_path('views/livewire'),
        //     resource_path('views/components'), 
        // ]);
    }
}
