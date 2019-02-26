<?php

namespace cadvisitante\Models;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $fillable     = [];
    //protected $table        = 'tb_user';
    protected $table        = 'tb_user_meta_data';
    protected $connection   = 'postgres';
    //protected $primaryKey   = 'co_user';
    protected $primaryKey   = 'co_user_meta_data';
    protected $guarded      = ['*'];   


}
