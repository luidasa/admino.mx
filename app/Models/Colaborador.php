<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaboradores';

    public function condominio() {
        return $this->belongsTo(Condominio::class, 'condominio_id');
    }

    public function remitente() {
        return $this->belongsTo(User::class, 'remitente_id');
    }
}
