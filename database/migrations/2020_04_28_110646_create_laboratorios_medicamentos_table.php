<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriosMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('med_id')->nullable();
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('med_id')->references('id')->on('medicamentos');
            $table->foreign('lab_id')->references('id')->on('laboratorios');
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
        Schema::dropIfExists('laboratorios_medicamentos');
    }
}
