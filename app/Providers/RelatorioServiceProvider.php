<?php namespace cadvisitante\Providers;

use Illuminate\Support\ServiceProvider;
use \cadvisitante\Models\Visitante as VisitanteModel;
use \cadvisitante\Models\Observers\Relatorio as RelatorioObserver;

class RelatorioServiceProvider extends ServiceProvider {

    public function boot()
    {
        VisitanteModel::observe(new RelatorioObserver);
    }
    public function register()
    {
        //
    }
}
