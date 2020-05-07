<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('linked_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('med_id');
            $table->string('h_MSRESO')->nullable();
            $table->string('h_DESCRIPCION')->nullable();
            $table->string('h_MSNomG')->nullable();
            $table->string('h_MSReg')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('med_id')->references('id')->on('medicamentos');
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
        Schema::dropIfExists('linked_medicamentos');
    }
}
