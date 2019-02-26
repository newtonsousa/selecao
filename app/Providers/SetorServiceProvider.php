<?php namespace selecao\Providers;

use Illuminate\Support\ServiceProvider;
use \selecao\Models\Setor as SetorModel;
use \selecao\Models\Observers\Setor as SetorObserver;

class SetorServiceProvider extends ServiceProvider {

    public function boot()
    {
        SetorModel::observe(new SetorObserver);
    }
    public function register()
    {
        //
    }
}
