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

            $factura->fecha_vencimiento = $request->input('fecha_vencimiento');
            $factura->fecha_inicio = $request->input('fecha_inicio');
            $factura->fecha_corte = $request->input('fecha_corte');
            $factura->condomino_id = $condomino->id;

            $factura->save();

            $cargos = $condomino->cargos()
                ->where('pagado_el', '<=', $request->input('fecha_corte'))
                ->where('pagado_el', '>=', $request->input('fecha_inicio'))
                ->get();

            $pagos = $condomino->pagos()
                ->where('pagado_el', '<=', $request->input('fecha_corte'))
                ->where('pagado_el', '>=', $request->input('fecha_inicio'))
                ->get();
            
            foreach($cargos as $cargo) {
                $totalCargos += $cargo->importe;
                $cargo->factura_id = $fatura->id;
                $cargo->save();
            }

            foreach($pagos as $pago) {
                $totalPagos =+ $pago->importe;
                $pago->factura_id = $fatura->id;
                $pago->save();
            }

            $factura->saldo_inicial = $condomino->ultima_factura()->saldo_final;
            $factura->pagos = $totalPagos;
            $factura->cargos = $totalCargos;
            $fatura->save;
        }
        die();
    }
}
