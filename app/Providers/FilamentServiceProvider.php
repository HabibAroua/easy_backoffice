<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Vite;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving
        (
            function()
            {
                Filament::registerTheme(app(Vite::class)('resources/css/filament.css'),);
                if(auth()->user())
                {
                    if(auth()->user()->is_admin === 1 && auth()->user()->hasAnyRole(['super-admin', 'admin', 'moderator']))
                    {
                        Filament::registerUserMenuItems
                        (
                            [
                                UserMenuItem::make()
                                    ->label('Manage Users')
                                    ->url(UserResource::getUrl())
                                    ->icon('heroicon-s-users'),
                                UserMenuItem::make()
                                    ->label('Manage Roles')
                                    ->url(UserResource::getUrl())
                                    ->icon('heroicon-s-cog'),
                                UserMenuItem::make()
                                    ->label('Manage Permissions')
                                    ->url(UserResource::getUrl())
                                    ->icon('heroicon-s-key')
                            ]
                        );
                    }
                }
            }
        );
    }
}
