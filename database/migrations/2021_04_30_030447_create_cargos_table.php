<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('factura_id')->nullable()->constrained('facturas');
            $table->foreignId('condomino_id')->constrained('condominos');
            $table->decimal('importe', $precision = 8, $scale = 2);
            $table->string('concepto');
            $table->string('estatus')->default('pendiente');
            $table->string('nombre_original')->nullable();
            $table->string('archivo')->nullable();
            $table->datetime('fecha_vencimiento');

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');

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
        Schema::dropIfExists('cargos');
    }
}
