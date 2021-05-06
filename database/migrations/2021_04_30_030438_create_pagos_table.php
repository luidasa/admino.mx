<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('factura_id')->nullable()->constrained('facturas');
            $table->foreignId('condomino_id')->constrained('condominos');
            $table->decimal('importe', $precision = 8, $scale = 2);
            $table->string('forma');
            $table->string('referencia')->nullable();
            $table->string('archivo')->nullable();
            $table->datetime('pagado_el');

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
        Schema::dropIfExists('pagos');
    }
}
