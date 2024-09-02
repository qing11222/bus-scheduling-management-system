<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        View::composer(
            ['user.mainpage', 'user.about_us', 'user.view_service', 'user.schedule', 'user.stop', 'user.tracking','user.find-bus-result','user.profile_detail','user.booking.index','user.booking.seats','user.booking.view','user.ticket.view'],
            function ($view) {
                if (Auth::check() && Auth::user()->usertype == 'user') {
                    $currentDate = now()->format('Y-m-d');
                    $results = DB::select('CALL GetAnnouncementsWithBusInfo(?)', [$currentDate]);
                    $announcements = collect($results);

                    $view->with('announcements', $announcements);
                }
            }
        );
}
}
