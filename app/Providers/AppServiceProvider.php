<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('layouts.unlock', function ($view) {
            
            $slug_header='all-header';
            $view->with('asset_all_header', \App\Models\Asset::where('slug',$slug_header)
			->where('status','active')->first());

            $slug_footer='all-footer';
            $view->with('asset_all_footer', \App\Models\Asset::where('slug',$slug_footer)
			->where('status','active')->first());
        });
    }
}
