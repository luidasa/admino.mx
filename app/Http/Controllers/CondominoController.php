<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condomino;

class CondominoController extends Controller
{
    //
    public function getIndex() {
        $condominos = Condomino::all();
        return view('condominos.index', ["condominos" => $condominos]);
    }

    public function getShow($id) {
        $condomino = Condomino::find($id);
        if (isset($condomino)) {
            return view('condominos.show', ['condomino' => $condomino]);
        } else {
            return redirect()->route('condominos');
        }
    }
}
