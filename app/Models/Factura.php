<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    public function pagos() {
        return $this->oneToMany(Pago::class);
    }

    public function cargos() {
        return $this->oneToMany(Cargo::class);
    }

    public function condomino() {
        return $this->belongsTo(Condomino::class, 'condomino_id');
    }
}
