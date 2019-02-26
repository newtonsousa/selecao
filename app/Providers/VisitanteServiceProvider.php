<?php namespace selecao\Providers;

use Illuminate\Support\ServiceProvider;
use \selecao\Models\Visitante as VisitanteModel;
use \selecao\Models\Observers\Visitante as VisitanteObserver;

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
