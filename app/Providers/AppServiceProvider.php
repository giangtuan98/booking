<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\route;
use App\place;
use Carbon\Carbon; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['page.index', 'page.booking', 'page.price-table', 'admin-page.route'], function($view){
            $nextdate = Carbon::now()->addDays(1)->format('d-m-Y'); 
            $place = place::all();
            $places = array();
            foreach ($place as $p) {
                $places[$p->place_id] =$p->place_name;
            }
            $view->with(['places'=>$places, 'nextdate'=>$nextdate]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
