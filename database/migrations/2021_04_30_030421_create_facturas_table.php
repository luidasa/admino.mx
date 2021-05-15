<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('condomino_id')->constrained('condominos');
            $table->unsignedBigInteger('factura_anterior_id')->nullable();

            $table->decimal('saldo_anterior', $precision = 8, $scale = 2);
            $table->decimal('cargos', $precision = 8, $scale = 2);
            $table->decimal('abonos', $precision = 8, $scale = 2);
            $table->decimal('saldo_actual', $precision = 8, $scale = 2);
            $table->date('fecha_vencimiento');
            $table->date('fecha_corte');
            $table->date('fecha_inicio');

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');

            $table->timestamps();

            $table->foreign('factura_anterior_id')->references('id')->on('facturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
