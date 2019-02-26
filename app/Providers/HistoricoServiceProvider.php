<?php namespace selecao\Providers;

use Illuminate\Support\ServiceProvider;
use \selecao\Models\Historico as HistoricoModel;
use \selecao\Models\Observers\Historico as HistoricoObserver;

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
