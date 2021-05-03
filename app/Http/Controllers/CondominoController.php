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
    public function getIndex() {
        $condominos = Condomino::all();
        return view('condominos.index', ["condominos" => $condominos]);
    }

    public function getShow($id) {
        $condomino = Condomino::find($id);
        if (isset($condomino)) {
            return view('condominos.show', ['condomino' => $condomino]);
        } else {
            return redirect()->route('condominos')->with(['error' => 'El condominio']);
        }
    }

    public function getEdit($id) {
        $condomino = Condomino::find($id);
        if (isset($condomino)) {
            return view('condominos.form', ['condomino' => $condomino]);
        } else {
            return redirect()->route('condominos');
        }
    }

    public function postEdit(Request $request, $id) {

        $data = $request;
        $condomino = Condomino::find($id);

        //echo $condomino. '<br>';
        //die();
        //echo $data . '<br/>';

        if (!isset($condomino)) {
            return redirect()->route('condominos');
        } else {
            $condomino->duenio = $data->input('duenio');
            $condomino->telefono = $data->input('telefono');
            $condomino->email = $data->input('email');
            $condomino->residente = $data->input('residente');
            $condomino->figura = $data->input('figura');
            $condomino->desocupada = $data->input('desocupada') !== null;

            $condomino->save();
            return redirect()->route('edit-condomino', ['id' => $condomino->id])->with(['alert-success' => 'Registro condominal actualizado'] );
        }
    }

    public function getCreate() {

        return view('condominos.form');
    }

    public function getBalance() {

        return view('condominos.balance');
    }

}
