<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Condomino;
use App\Models\Cargo;

use Carbon\Carbon;


class FacturaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {

        $facturas = Factura::
            where('fecha_vencimiento', '<', Carbon::now()->lastOfMonth())
            ->where('fecha_vencimiento', '>=', Carbon::now()->startOfMonth())
            ->paginate(10);
        return view('facturas.index', ['facturas' => $facturas]);
    }

    public function getFacturasCondomino($condomino_id) {

        $facturas = Factura::
        where('condomino_id', $condomino_id)
        ->orderBy('fecha_vencimiento', 'desc')
        ->paginate(10);
    return view('facturas.index', ['facturas' => $facturas]);

    }

    public function getShow() {
        return 'aqui se va a mostrar la factura';
    }

    public function getGenerate() {
        return view('facturas.form');
    }

    public function postGenerate(Request $request) {

        $validateData = $this->validate($request, [
            'fecha_vencimiento' => 'required|date',
            'fecha_inicio'      => 'required|date',
            'fecha_corte'       => 'required|date'
        ]);
        $condominos = Condomino::all();
        foreach($condominos as $condomino) {

            $totalCargos = 0;
            $totalPagos = 0;
            $factura = new Factura();
            $facturaAnterior = Factura::find($condomino->ultima_factura_id);

            $factura->fecha_vencimiento = $request->input('fecha_vencimiento');
            $factura->fecha_inicio = $request->input('fecha_inicio');
            $factura->fecha_corte = $request->input('fecha_corte');
            $factura->abonos = 0;
            $factura->cargos = 0;
            $factura->saldo_actual = 0;
            $factura->created_by          = \Auth::user()->id; 
            $factura->updated_by          = \Auth::user()->id; 
            $factura->condomino_id = $condomino->id;

            if ($facturaAnterior !== null) {
                $factura->saldo_anterior = $facturaAnterior->saldo_actual;
            } else {
                $factura->saldo_anterior = 0;
            }

            $factura->save();

            $cargos = $condomino->cargos()
                ->where('fecha_vencimiento', '<=', $request->input('fecha_corte'))
                ->where('fecha_vencimiento', '>=', $request->input('fecha_inicio'))
                ->get();

            $pagos = $condomino->pagos()
                ->where('pagado_el', '<=', $request->input('fecha_corte'))
                ->where('pagado_el', '>=', $request->input('fecha_inicio'))
                ->get();
            
            foreach($cargos as $cargo) {
                $totalCargos        += $cargo->importe;
                $cargo->factura_id  = $factura->id;
                $cargo->updated_by  = \Auth::user()->id; 
                $cargo->save();
            }

            foreach($pagos as $pago) {
                $totalPagos         =+ $pago->importe;
                $pago->factura_id   = $factura->id;
                $pago->updated_by   = \Auth::user()->id; 
                $pago->save();
            }

            $factura->abonos = $totalPagos;
            $factura->cargos = $totalCargos;
            $factura->saldo_actual = $factura->saldo_anterior + $totalCargos - $totalPagos; 
            $factura->save();

            $condomino->ultima_factura_id   = $factura->id;
            $condomino->updated_by          = \Auth::user()->id; 
            $condomino->save();
        }

        return redirect()
            ->route('last-facturas')
            ->with(['alert-success' => 'Facturas generadas.']);

    }
}
