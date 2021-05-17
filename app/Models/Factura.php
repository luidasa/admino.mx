<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    public function items_pagos() {
        return $this->hasMany(Pago::class);
    }

    public function items_cargos() {
        return $this->hasMany(Cargo::class);
    }

    public function condomino() {
        return $this->belongsTo(Condomino::class);
    }
}
