<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo_medicamento')->unique();
            $table->string('cod_insumo')->nullable();
            $table->string('nombre_generico')->nullable();
            $table->string('nombre_comercial')->nullable();
            $table->unsignedBigInteger('id_formaf')->nullable();
            $table->string('presentacion_comercial')->nullable();
            $table->string('alto_costo')->nullable();
            $table->string('regulado')->nullable();
            $table->float('precio_regulado')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('estado')->default(1);

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('medicamentos');
    }
}
