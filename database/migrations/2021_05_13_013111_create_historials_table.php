<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->increments('id_historial');
            $table->string('folio');
            $table->unsignedInteger('id_puesto')->nullable();
            $table->unsignedInteger('id_statu'); 
            $table->date('fecha_entrada');
            $table->time('hora_entrada');
            // $table->date('fecha_salida');
            $table->time('hora_salida')->nullable();
            $table->string('totalhr')->nullable();
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
        Schema::dropIfExists('historials');
    }
}
