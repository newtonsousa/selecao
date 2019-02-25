<?php namespace cadvisitante\Providers;

use Illuminate\Support\ServiceProvider;
use \cadvisitante\Models\TipoDocumento as TipoDocumentoModel;
use \cadvisitante\Models\Observers\TipoDocumento as TipoDocumentoObserver;

class TipoDocumentoServiceProvider extends ServiceProvider {

    public function boot()
    {
        TipoDocumentoModel::observe(new TipoDocumentoObserver);
    }
    public function register()
    {
        //
    }
}
