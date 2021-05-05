<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condomino extends Model
{
    use HasFactory;

    public function facturas() {
        return $this->hasMany(Factura::class);
    }

    public function pagos() {
        return $this->hasMany(Pago::class);
    }
}
