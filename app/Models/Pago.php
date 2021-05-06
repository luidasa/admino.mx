<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    public function condomino() {
        return $this->belongsTo(Condomino::class, 'condomino_id');
    }
}
