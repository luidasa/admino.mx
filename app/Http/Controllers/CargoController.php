<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Condomino;
use App\Models\Cargo;

use Carbon\Carbon;

class CargoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex($condominio_id, $condomino_id) {
        $condomino  = Condomino::find($condomino_id);
        if ($condomino !== null) {
            if ($condomino->condominio->id != $condominio_id) {
                return redirect()
                    ->route('condominos', ['condominio_id' => $condominio_id])
                    ->with(['danger-alert' => 'El condominio no existe']);
            } else {
                $cargos     = $condomino->cargos()
                    ->where('fecha_vencimiento', '<', Carbon::now()->addMonth())
                    ->orderBy('fecha_vencimiento', 'desc')
                    ->paginate(10);
                return view('cargos.index', [
                    'condomino' => $condomino,
                    'cargos'    => $cargos
                ]);
            }
        } else {
            return redirect()->route('condominos')->with(['danger-alert' => 'El condominio no existe']);
        }
    }

    public function getEdit($id) {

        $cargo = Cargo::find($id);
        if ($cargo === null) {
            return redirect()->route('condominos', ['condominio_id' => session('condominio_id')])
                ->with(['danger-alert' => "No existe ese cargo registrado"]);
        }
        return view('cargos.form', [
            'condominio_id' => session('condominio_id'),
            'condomino'     => $cargo->condomino,
            'cargo'         => $cargo
        ]);
    }

    public function getCreate($condominio_id, $condomino_id) {

        $condomino = Condomino::find($condomino_id);
        if ($condomino !== null) {
            return view('cargos.form', [
                'condomino' => $condomino
            ]);
        } else {
            return redirect()
                ->route('condominos', ['condominio_id' => $condominio_id])
                ->with(['danger-alert' => 'El condominio no existe']);
        }
    }

    public function postCreate(Request $request, $condominio_id, $condomino_id) {

        $validateData = $this->validate($request, [
            'fecha_vencimiento' => 'required|date',
            'importe'           => 'required|numeric|gt:0',
            'concepto'          => 'required|string',
            'comprobante'       => 'mimes:jpg,bmp,png,pdf'
        ]);
        $condomino = Condomino::find($condomino_id);
        if ($condomino !== null) {
            $cargo = new Cargo();
            $cargo->fecha_vencimiento   = $request->input('fecha_vencimiento');
            $cargo->importe             = $request->input('importe');
            $cargo->concepto            = $request->input('concepto');
            $cargo->created_by          = \Auth::user()->id;
            $cargo->updated_by          = \Auth::user()->id;

            if ($request->file('comprobante')) {
                $cargo->nombre_original = $request->file('comprobante')->getClientOriginalName();
                $cargo->archivo = $request->file('comprobante')->store('evidencias');
            }

            $condomino->cargos()->save($cargo);
            error_log('Grabamos el cargo.');
            return redirect()
                ->route('cargos', ['condominio_id' => $condominio_id, 'condomino_id' => $condomino_id])
                ->with(['alert-success' => 'Cargo registrado, se vera reflejado en su siguiente estado de cuenta.']);
        } else {
            return redirect()->route('condominos', ['condominio_id' => $condominio_id])->with(['alert-danger' => 'El condominio no existe']);
        }
    }

    public function getComprobante($id) {
        ob_end_clean();
        $headers = array(
            'Content-Type: image/png',
        );

        $cargo = Cargo::find($id);
        if ($cargo !== null) {
            return Storage::download($cargo->archivo, $cargo->nombre_original, $headers);
        } else {
        return redirect()->route('condominos')->with(['alert-danger' => 'El pago no existe']);
        }
    }
}
