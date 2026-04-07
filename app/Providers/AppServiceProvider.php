<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OfficeAttendance;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        /**
         * Mengirim data notifikasi absensi ke semua view (sidebar)
         * Khusus untuk pengguna dengan role 'admin'
         */
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->role === 'admin') {
                /** * Perubahan: Hitung hanya data yang belum dilihat (is_seen = false)
                 * Filter Carbon::today() bisa tetap dipakai jika ingin notifikasi
                 * hanya muncul untuk data hari ini saja yang belum dibaca.
                 */
                $attendanceNotification = OfficeAttendance::where('is_seen', false)
                    ->whereDate('date', Carbon::today())
                    ->count();

                $view->with('attendanceNotification', $attendanceNotification);
            }
        });
    }
}
