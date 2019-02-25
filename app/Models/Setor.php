<?php

namespace cadvisitante\Models;

use Illuminate\Database\Eloquent\Model;
use \Config as Config;

class Setor extends Model
{
    protected $fillable     = [];
    protected $table        = 'tb_department';
    protected $connection   = 'postgres';
    protected $primaryKey   = 'co_department';
    protected $guarded      = ['*'];   


}
