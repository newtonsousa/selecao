<?php namespace cadvisitante\Providers;

use Illuminate\Support\ServiceProvider;
use \cadvisitante\Models\Historico as HistoricoModel;
use \cadvisitante\Models\Observers\Historico as HistoricoObserver;

class HistoricoServiceProvider extends ServiceProvider {

    public function boot()
    {
        HistoricoModel::observe(new HistoricoObserver);
    }
    public function register()
    {
        //
    }
}
