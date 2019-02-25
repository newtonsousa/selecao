<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Historico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('str_nome', 200)->nullable();
            $table->integer('int_codito_visitante');
            $table->string('int_telefone')->nullable();
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
        Schema::drop('historico');
    }
}
