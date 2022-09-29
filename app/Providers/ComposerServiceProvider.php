<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\BikeComposer;

class ComposerServiceProvider extends ServiceProvider
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
        // Using class based composers...
        View::composer(
            //['bikes.list', 'bikes.create'], // Vincula el View Composer a 2 vistas
            '*', // Todas la vistas dispondrán de los datos compartidos en BikeComposer ($total)
            BikeComposer::class
        );
    }
}
