<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Condominio;
use App\Models\Condomino;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'estado'        => ['required', 'string']
        ]);

        $condominio = new Condominio();
        $condominio->nombre         = $request->input('nombre');
        $condominio->direccion      = $request->input('direccion');
        $condominio->codigo_postal  = $request->input('codigo_postal');
        $condominio->estado         = $request->input('estado');
        $condominio->numero_condominos  = $request->input('numero_condominos');
        $condominio->prefijo_condominos = $request->input('prefijo_condominos');
        $condominio->estado         = $request->input('estado');
        $condominio->save();

        Auth::user()->condominios()->attach($condominio);

        $colaborador = new Colaborador();
        $colaborador->colaborador_id     = Auth::user()->id;
        $colaborador->destinatario       = Auth::user()->email;
        $colaborador->fecha_expiracion   = Carbon::now();
        $colaborador->fecha_aceptacion   = Carbon::now();
        $colaborador->estatus            = 'Aceptado';
        $colaborador->role               = 'Administrador';
        $colaborador->condominio_id      = $condominio->id;
        $colaborador->remitente_id       = Auth::user()->id;
        $colaborador->save();

        // Ahora creamos todos los condominos,
        for($i = 0; $i < $condominio->numero_condominos; $i++) {
            $condomino                 = new Condomino();
            $condomino->duenio         = Str::random(10);
            $condomino->telefono       = Str::random(10);
            $condomino->email          = Str::random(10). '@gmail.com';
            $condomino->interior       = $condominio->prefijo_condominos . ($i + 1);

            $condominio->condominos()->save($condomino);
        }
        session(['condominio_id' => $condominio->id]);
        return redirect()
            ->route('edit-condominio', ['id' => $condominio->id])
            ->with('alert-success', 'Condominio creatado ahora eres el administrador del mismo');
    }

    public function getEdit($id) {

        $condominio = Condominio::findOrFail($id);
        $cargos     = $condominio->cargos_recurrentes()->paginate(5);
        session(['condominio_id' => $condominio->id]);
        return view('condominios.form', ['condominio' => $condominio, 'cargos' => $cargos]);
    }

    public function postEdit(Request $request, $id) {

        $request->validate([
            'nombre'        => ['required' ,'unique:condominios'],
            'direccion'     => ['required','min:10'],
            'codigo_postal' => ['required','digits:5'],
            'estado'        => ['required', 'string'],
            'logotipo'      => ['present', 'mimes:jpeg,bmp,png,jpg,gif']
        ]);

        $condominio = Condominio::find($id);
        $condominio->nombre         = $request->input('nombre');
        $condominio->direccion      = $request->input('direccion');
        $condominio->codigo_postal  = $request->input('codigo_postal');
        $condominio->estado         = $request->input('estado');
        $condominio->save();

        session(['condominio_id' => $condominio->id]);

        return redirect()
            ->route('edit-condominio', ['id', $condominio->id])
            ->with('alert-success', 'Condominio actualizado');

    }

    public function postPermisos(Request $request, $id) {

        $condominio = Condominio::find($id);
        return redirect()
            ->route('edit-condominio', ['id', $condominio->id])
            ->with('alert-success', 'Condominio actualizado');

    }
}
