<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condomino;

class PagosController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex($condomino_id) {
        $condomino = Condomino::find($condomino_id);
        if ($condomino !== null) {
            return view('pagos.index', [
                'condomino' => $condomino,
                'pagos' => $condomino->pagos()
            ]);
        } else {
            return redirect()->route('condosminos')->with(['danger-alert' => 'El condominio no existe']);
        }
    }

    public function getCreate(Request $request, $condomino_id) {

        return view('pagos.form');
    }
}
