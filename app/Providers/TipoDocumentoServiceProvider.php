<?php namespace selecao\Providers;

use Illuminate\Support\ServiceProvider;
use \selecao\Models\TipoDocumento as TipoDocumentoModel;
use \selecao\Models\Observers\TipoDocumento as TipoDocumentoObserver;

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
