<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondominosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominos', function (Blueprint $table) {
            $table->id();

            $table->string('duenio');
            $table->string('telefono');
            $table->string('email');
            $table->string('residente')->nullable();
            $table->string('figura')->nullable();
            $table->string('interior');
            $table->boolean('desocupada')->default(false);
            $table->unsignedBigInteger('ultima_factura')->nullable();
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
        Schema::dropIfExists('condominos');
    }
}
