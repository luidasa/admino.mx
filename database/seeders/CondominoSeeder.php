<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condomino;
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
        //
        for($i = 0; $i < 51; $i++) {
            $condominio = new Condomino();
            $condominio->duenio = Str::random(10);
            $condominio->telefono = Str::random(10);
            $condominio->email = Str::random(10). '@gmail.com';
            $condominio->interior = 'casa ' . ($i + 1);

            $condominio->save();
        }
    }
}
