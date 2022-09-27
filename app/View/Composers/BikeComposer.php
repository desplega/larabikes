<?php
namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Bike;

class BikeComposer {
    /**
     * Bind data to the view.
     * 
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('total', Bike::count());
    }
}