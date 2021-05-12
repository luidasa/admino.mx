<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getCargos() {
        return view('configuracion.cargos.index');
    }
}
