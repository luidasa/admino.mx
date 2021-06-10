<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('colaborador_id')->nullable()->constrained('users');
            $table->foreignId('remitente_id')->constrained('users');
            $table->foreignId('condominio_id')->constrained('condominios');
            $table->string('destinatario');
            $table->dateTime('fecha_expiracion');
            $table->dateTime('fecha_aceptacion')->nullable();
            $table->enum('role', ['Presidente', 'Secretario', 'Tesorero', 'Vocal', 'Administrador', 'Residente', 'Condomino']);
            $table->enum('estatus', ['Invitado', 'Aceptado', 'Declinado', 'Cancelado'])->default('Invitado');

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
        Schema::dropIfExists('colaboradores');
    }
}
