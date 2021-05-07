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
        $condomino  = Condomino::find($condomino_id);
        $pagos      = $condomino->pagos()->paginate(5);
        if ($condomino !== null) {
            return view('pagos.index', [
                'condomino' => $condomino,
                'pagos'     => $pagos
            ]);
        } else {
            return redirect()->route('condominos')->with(['danger-alert' => 'El condominio no existe']);
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
            'pagado_el'     => 'required|date',
            'importe'       => 'required|numeric|gt:0',
            'referencia'    => 'required|min:20|max:300',
            'forma'         => 'required|string',
            'comprobante'   => 'mimes:jpg,bmp,png,pdf'
        ]);
        if ($condomino !== null) {
            $pago = new Pago();
            $pago->pagado_el = $request->input('pagado_el');
            $pago->importe = $request->input('importe');
            $pago->forma = $request->input('forma');
            $pago->referencia = $request->input('referencia');
            $pago->created_by = \Auth::user()->id; 
            $pago->updated_by = \Auth::user()->id; 

            if ($request->file('comprobante')) {
                $pago->archivo = $request->file('comprobante')->store('comprobantes');
            } 
            
            $condomino->pagos()->save($pago);
            error_log('Grabamos el pago.');
            return redirect()
                ->route('pagos', ['condomino_id' => $condomino_id])
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
