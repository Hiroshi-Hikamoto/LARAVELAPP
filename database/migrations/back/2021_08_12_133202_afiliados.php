<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Afiliados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('afiliados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('Cedula');
            $table->string('Primer_Nombre')->nullable();
            $table->string('Segundo_Nombre')->nullable();
            $table->string('Primer_Apellido')->nullable();
            $table->string('Segundo_Apellido')->nullable();
            $table->string('Telefono')->nullable();
            $table->string('Direccion')->nullable();
            $table->string('Fecha_Nacimiento')->nullable();
            $table->string('Parentesco')->nullable();
            $table->bigInteger('lider')->nullable();
            $table->integer('estado')->nullable()->default(1);
            //$table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
