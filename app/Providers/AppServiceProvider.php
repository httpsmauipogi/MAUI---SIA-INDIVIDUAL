<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();

        View::composer('partials.backend.sidebar', function ($view) {
            $view->with([
                'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
                'unreadNotificationsCount' => auth()->user()?->unreadNotifications->count() ?? 0,
            ]);
        });

        View::composer('partials.backend.topbar', function ($view) {
            $user = auth()->user();

            $view->with([
                'unreadNotificationsCount' => $user?->unreadNotifications->count() ?? 0,
                'recentNotifications' => $user?->notifications->take(6) ?? collect(),
            ]);
        });
    }
}
