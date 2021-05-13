<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos_generales', function (Blueprint $table) {         
            $table->id();

            $table->string('concepto');
            $table->string('descripcion');
            $table->decimal('importe', $precision = 8, $scale = 2);
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin')->nullable();
            $table->integer('periodicidad')->default(1); 
            $table->string('estatus')->default('creado'); //['creado', 'planeado', 'pagando', 'cancelado']
            $table->integer('repeticiones');
            $table->integer('descuento_por_desocupada')->default(0);
            $table->string('nombre_original')->nullable();
            $table->string('archivo')->nullable();

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
        Schema::dropIfExists('cargos_generales');
    }
}
