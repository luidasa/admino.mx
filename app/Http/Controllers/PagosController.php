<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $pagos      = $condomino->pagos()->orderBy('id', 'desc')->paginate(10);
        if ($condomino !== null) {
            return view('pagos.index', [
                'condomino' => $condomino,
                'pagos'     => $pagos
            ]);
        } else {
            return redirect()->route('condominos')->with(['danger-alert' => 'El condominio no existe']);
        }
    }

    public function getCreate($condominio_id, $condomino_id) {

        $condomino = Condomino::find($condomino_id);
        if ($condomino == null) {
            return redirect()->route('condominos')->with(['danger-alert' => 'El condomino no existe']);
        } else {
            if ($condomino->condominio->id != $condominio_id) {
                return redirect()
                    ->route('condominos', ['condominio_id' => $condominio_id])
                    ->with(['danger-alert' => 'El condomino no existe en ese condominio']);
            } else {
                return view('pagos.form', [
                    'condominio_id' => $condominio_id, 'condomino' => $condomino
                ]);
            }
        }
    }

    public function postCreate(Request $request, $condominio_id, $condomino_id) {

        $validateData = $this->validate($request, [
            'pagado_el'     => 'required|date',
            'importe'       => 'required|numeric|gt:0',
            'referencia'    => 'required|min:20|max:300',
            'forma'         => 'required|string',
            'comprobante'   => 'mimes:jpg,bmp,png,pdf'
        ]);
        $condomino = Condomino::find($condomino_id);
        if ($condomino !== null) {
            $pago = new Pago();
            $pago->pagado_el = $request->input('pagado_el');
            $pago->importe = $request->input('importe');
            $pago->forma = $request->input('forma');
            $pago->referencia = $request->input('referencia');
            $pago->created_by = \Auth::user()->id;
            $pago->updated_by = \Auth::user()->id;

            if ($request->file('comprobante')) {
                $pago->nombre_original = $request->file('comprobante')->getClientOriginalName();
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
                'pago'      => $pago,
            ]);
        } else {
            return redirect()->route('condominos')->with(['alert-danger' => 'El pago no existe']);
        }
    }

    public function postEdit(Request $request, $id) {

        $validateData = $this->validate($request, [
            'pagado_el'     => 'required|date',
            'importe'       => 'required|numeric|gt:0',
            'referencia'    => 'required|min:20|max:300',
            'forma'         => 'required|string',
            'comprobante'   => 'mimes:jpg,bmp,png,pdf'
        ]);
        $pago = Pago::find($id);
        if ($pago !== null) {
            $pago->pagado_el = $request->input('pagado_el');
            $pago->importe = $request->input('importe');
            $pago->forma = $request->input('forma');
            $pago->referencia = $request->input('referencia');
            $pago->updated_by = \Auth::user()->id;

            if ($request->file('comprobante')) {
                $pago->nombre_original = $request->file('comprobante')->getClientOriginalName();
                $pago->archivo = $request->file('comprobante')->store('comprobantes');
            }

            $pago->save();
            return redirect()
                ->route('pagos', ['condomino_id' => $pago->condomino->id])
                ->with(['alert-success' => 'Pago registrado, se vera reflejado en su siguiente estado de cuenta.']);
        } else {
            return redirect()->route('condominos')->with(['alert-danger' => 'El pago no existe']);
        }
    }

    public function getComprobante($id) {
        ob_end_clean();
        $headers = array(
            'Content-Type: image/png',
        );

        $pago = Pago::find($id);
        if ($pago !== null) {
//            $file = Storage::disk('comprobantes')->get($pago->archivo);
//            return new Response($file, 200);
            return Storage::download($pago->archivo, $pago->nombre_original, $headers);
        } else {
        return redirect()->route('condominos')->with(['alert-danger' => 'El pago no existe']);
        }
    }
 }
