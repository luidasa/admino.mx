<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'codigo_postal',
        'estado'
    ];

    public function condominos() {
        return $this->hasMany(Condomino::class);
    }

    public function colaboradores() {
        return $this->hasMany(Colaborador::class);
    }

    public function cargos_recurrentes() {
        return $this->hasMany(CargoGeneral::class);
    }
}
