<?php

namespace App\Http\Controllers;

use App\Models\Condominio;
use App\Models\Condomino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CondominioController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {

        return view('condominios.index', [
            'condominios' => Auth::user()->condominios()->paginate(10)
        ]);
    }

    public function getCreate() {
        return view('condominios.form');
    }

    public  function postCreate(Request $request) {

        $request->validate([
            'nombre'        => ['required' ,'unique:condominios'],
            'direccion'     => ['required','min:10'],
            'codigo_postal' => ['required','digits:5'],
            'estado'        => ['required', 'string'],
            'logotipo'      => ['mimes:jpeg,bmp,png,jpg,gif']
        ]);

        $condominio = Condominio::created([
            'nombre'        => $request->input('nombre'),
            'direccion'     => $request->input('direccion'),
            'codigo_postal' => $request->input('codigo_postal'),
            'estado'        => $request->input('estado')
        ]);

        // Ahora creamos todos los condominos,
        for($i = 0; $i < $request->input('numero_condominos'); $i++) {
            $condomino                 = new Condomino();
            $condomino->duenio         = Str::random(10);
            $condomino->telefono       = Str::random(10);
            $condomino->email          = Str::random(10). '@gmail.com';
            $condomino->interior       = $request->input('prefijo_condominos') . ($i + 1);

            $condominio->condominos()->save($condomino);
        }

        return redirect()->route('update-condominio', ['id', $condominio->id])->with('alert-success', 'Condominio creatado ahora eres el administrador del mismo');
    }

    public function getEdit($id) {


    }

    public function postEdit(Request $request, $id) {


    }
}
