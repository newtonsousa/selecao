<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Visitante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitante', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('str_nome', 200);
            $table->string('str_endereco', 200);
            $table->string('str_empresa_orgao', 100);
            $table->string('int_tipo_documento');
            $table->string('int_numero_documento');
            $table->string('int_telefone');
            $table->string('int_celular');
            $table->string('int_codigouf');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visitante');
    }
}
