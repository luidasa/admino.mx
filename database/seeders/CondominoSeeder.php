<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condomino;
use App\Models\Condominio;
use Illuminate\Support\Str;

class CondominoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos el condominio 
        $condominio                 = new Condominio();
        $condominio->nombre         = 'Privada 110 de Villas Fontana II';   
        $condominio->domicilio      = 'Cerrada de Monte Sacro Privada 110, Villas Fontana II, Queretaro Qro.';   
        $condominio->codigo_postal  = '76148';   
        $condominio->estado         = 'Queretaro';   
        $condominio->save();

        for($i = 0; $i < 51; $i++) {
            $condomino                 = new Condomino();
            $condomino->duenio         = Str::random(10);
            $condomino->telefono       = Str::random(10);
            $condomino->email          = Str::random(10). '@gmail.com';
            $condomino->interior       = 'Casa ' . ($i + 1);

            $condominio->condominos()->save($condomino);
        }
    }
}
