<?php namespace selecao\Providers;

use Illuminate\Support\ServiceProvider;
use \selecao\Models\Visitante as VisitanteModel;
use \selecao\Models\Observers\Relatorio as RelatorioObserver;

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
