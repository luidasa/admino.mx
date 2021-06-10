<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condomino;

class CondominoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    //
    public function getIndex(Request $request, $condominio_id) {

        $condominos = Condomino::where('condominio_id', $condominio_id)->paginate(10);
        return view('condominos.index', ["condominos" => $condominos]);
    }

    public function getShow($condominio_id, $id) {
        $condomino = Condomino::find($id);
        if (isset($condomino)) {
            return view('condominos.show', ['condomino' => $condomino]);
        } else {
            return redirect()->route('condominos')->with(['error' => 'El condominio']);
        }
    }

    public function getEdit($condominio_id, $id) {
        $condomino = Condomino::find($id);
        if (isset($condomino)) {
            return view('condominos.form', ['condomino' => $condomino]);
        } else {
            return redirect()->route('condominos');
        }
    }

    public function postEdit(Request $request, $condominio_id, $id) {

        $data = $request;
        $condomino = Condomino::find($id);

        //echo $condomino. '<br>';
        //die();
        //echo $data . '<br/>';

        if (!isset($condomino)) {
            return redirect()->route('condominos');
        } else {
            $condomino->duenio = $data->input('duenio');
            $condomino->interior = $data->input('interior');
            $condomino->telefono = $data->input('telefono');
            $condomino->email = $data->input('email');
            $condomino->residente = $data->input('residente');
            $condomino->figura = $data->input('figura');
            $condomino->desocupada = $data->input('desocupada') !== null;

            $condomino->save();
            return redirect()
                ->route('edit-condomino', ['condominio_id' => $condominio_id, 'id' => $condomino->id])
                ->with(['alert-success' => 'Registro condominal actualizado'] );
        }
    }

    public function getCreate($condominio_id) {

        return view('condominos.form');
    }

    public function getBalance($condominio_id) {

        return view('condominos.balance');
    }

}
