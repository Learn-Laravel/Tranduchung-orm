<?php

namespace App\Providers;
use App\View\Components\Alert;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Input\Button;

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
        // Blade::directive('datetime', function($expression){
        //     $expression =trim($expression, '\'');
        //     $expression = trim($expression, '""');
        //     $dateObject = date_create($expression);
        //     $dateFormat =$dateObject -> format('d/m/Y H:i:s');
        //     if (!empty($dateObject)){
        //         return  $dateFormat;
        //     }
        //     return false;
        // });
        Blade::if('env', function($value){
            // trar ve gia tri boolean
            if(config('app.env') === $value){
                return true;
            }
            return false;
        });
        Blade::component('package-alert', Alert::class);
        Blade::component('button', Button::class);
    }
}
