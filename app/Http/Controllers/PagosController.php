<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Condomino;
use App\Models\Pago;

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

    public function getCreate($condomino_id) {

        $condomino = Condomino::find($condomino_id);
        if ($condomino !== null) {
            return view('pagos.form', [
                'condomino' => $condomino
            ]);        
        } else {
            return redirect()->route('condominos')->with(['danger-alert' => 'El condominio no existe']);
        }
    }

    public function postCreate(Request $request, $condomino_id) {
        $condomino = Condomino::find($condomino_id);

        $validateData = $this->validate($request, [
            'pagado_el'     => 'required|date|after:created_at|before:start_date',
            'importe'       => 'required|number|gt:0',
            'referencia'    => 'required|min:20|max:300',
            'comprobante'   => 'mimes:jpg,bmp,png,pdf'
        ]);
        if ($condomino !== null) {
            $pago = new Pago();
            $pago->pagado_el = $request->input('pagado_el');
            $pago->importe = $request->input('importe');
            $pago->forma = $request->input('forma');
            $pago->referencia = $request->input('referencia');

            if ($request->hasFile('comprobante')) {
                $path = $request->file('comprobante')->store('comprobantes');
            }

            $condomino->pagos()->save($pago);
            return redirect()->route('pagos', ['condomino_id' => $condomino_id])
                ->with(['alert-success' => 'Pago registrado, se vera reflejado en su siguiente estado de cuenta.']);
        } else {
            return redirect()->route('condominos')->with(['alert-danger' => 'El condominio no existe']);
        }
    }

    public function getEdit($id) {

        $pago = Pago::find($id);
        if ($pago !== null) {
            return view('pagos.form', [
                'condomino' => $pago->condomino,
                'pago' => $pago,
            ]);
        } else {
            return redirect()->route('condominos')->with(['alert-danger' => 'El pago no existe']);
        }
    }
 }
