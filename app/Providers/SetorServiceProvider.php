<?php namespace cadvisitante\Providers;

use Illuminate\Support\ServiceProvider;
use \cadvisitante\Models\Setor as SetorModel;
use \cadvisitante\Models\Observers\Setor as SetorObserver;

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
