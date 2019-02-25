<?php namespace cadvisitante\Providers;

use Illuminate\Support\ServiceProvider;
use \cadvisitante\Models\Destino as DestinoModel;
use \cadvisitante\Models\Observers\Destino as DestinoObserver;

class DestinoServiceProvider extends ServiceProvider {

    public function boot()
    {
        DestinoModel::observe(new DestinoObserver);
    }
    public function register()
    {
        //
    }
}
