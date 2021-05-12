<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Condomino;
use App\Models\Factura;

class Pago extends Model
{
    use HasFactory;

    public function condomino() {
        return $this->belongsTo(Condomino::class, 'condomino_id');
    }

    public function factura() {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
