<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Planta;

class PlantaComposer
{
    //metodo que vincula la informacion a la vista
    public function compose(View $view)
    {
        $view->with('total', Planta::count());
    }
}
