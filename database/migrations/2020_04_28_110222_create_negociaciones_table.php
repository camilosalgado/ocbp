<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('med_id')->nullable();
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->float('vpropuesta')->nullable();
            $table->text('obs_descuento')->nullable();
            $table->float('vnegociacion')->nullable();
            $table->float('utilidad')->nullable();
            $table->boolean('aprob_farmacia')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('estado')->default(1);

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
        Schema::dropIfExists('negociaciones');
    }
}
