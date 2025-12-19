<?php

namespace App\Providers;

use App\Contracts\FolderServiceInterface;
use App\Models\Folder;
use App\Services\FolderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(FolderServiceInterface::class, FolderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
