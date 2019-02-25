<?php namespace cadvisitante\Providers;

use Illuminate\Support\ServiceProvider;
use \cadvisitante\Models\Visitante as VisitanteModel;
use \cadvisitante\Models\Observers\Visitante as VisitanteObserver;

class VisitanteServiceProvider extends ServiceProvider {

    public function boot()
    {
        VisitanteModel::observe(new VisitanteObserver);
    }
    public function register()
    {
        //
    }
}
