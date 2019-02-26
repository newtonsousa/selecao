<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();
//
//        $this->call('ExtracaoTableSeeder');
//        $this->call('TipoArquivoTableSeeder');
//
//        Model::reguard();
        
        
        Eloquent::unguard();
 
        $this->call('User');
        
        
    }
}
