<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condomino;

class CondominoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0; $i < 51; $i++) {
            $condominio = new Condomino();
            $condominio->duenio = '';
            $condominio->telefono = '';
            $condominio->email = '';
            $condominio->interior = 'casa ' . ($i + 1);

            $condominio->save();
        }
    }
}
