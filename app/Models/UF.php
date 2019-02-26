<?php

namespace selecao\Models;

use Illuminate\Database\Eloquent\Model;

use \Config as Config;

class UF extends Model
{   
    
    protected $fillable     = [];
    protected $table        = 'comum.uf';
    protected $connection   = 'oracle';
    protected $primaryKey   = 'int_codigouf';
    protected $guarded      = ['*'];
    

//    public static function getAllUfs() {
//        $all_ufs = UF::all()->toArray();
//       return $all_ufs;
//         
//    }
    
}

