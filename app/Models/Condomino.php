<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condomino extends Model
{
    use HasFactory;

    public function ultima_factura() {
        return $this->hasOne(Factura::class, 'ultima_factura_id', 'id');
    }

    public function facturas() {
        return $this->hasMany(Factura::class);
    }

    public function pagos() {
        return $this->hasMany(Pago::class);
    }

    public function cargos() {
        return $this->hasMany(Cargo::class);
    }
}
