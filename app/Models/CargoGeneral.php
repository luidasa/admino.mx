<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargoGeneral extends Model
{
    use HasFactory;

    protected $table = 'cargos_generales';

    public function cargos() {
        return $this->hasMany(Cargo::class);
    }
}
