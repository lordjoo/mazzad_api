<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::registerRenderHook(
            'head.end',
            function () {
                $arr = [
                    "https://code.jquery.com/jquery-3.3.1.min.js",
                    "https://unpkg.com/@fonticonpicker/fonticonpicker/dist/js/jquery.fonticonpicker.min.js",
                    asset("iconpicker/init.js")
                ];
                $str = "";
                foreach ($arr as $item) {
                    $str .= "<script src='$item'></script>";
                }
                return $str;
            }
        );

        Filament::registerStyles([
            "https://unpkg.com/@fonticonpicker/fonticonpicker@3.1.1/dist/css/base/jquery.fonticonpicker.min.css",
            "https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css",
            "https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css"
        ]);
    }
}
