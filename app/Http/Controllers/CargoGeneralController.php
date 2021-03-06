<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CargoGeneral;
use App\Models\Cargo;
use App\Models\Condomino;

use Carbon\Carbon;

class CargoGeneralController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        $cargos = CargoGeneral::paginate(10);
        return view('cargosrecurrentes.index', ['cargos' => $cargos]);
    }

    public function getCreate() {
        return view('cargosrecurrentes.form', ['cargo' => new CargoGeneral()]);
    }
        
    public function postCreate(Request $request) {

        $validateData = $this->validate($request, [
            'fecha_inicio'      => 'required|date',
            'repeticiones'      => 'required|numeric|gt:0',
            'periodicidad'      => 'required|string',
            'importe'           => 'required|numeric|gt:0',
            'repeticiones'      => 'required|numeric|gte:0|lte:12',
            'concepto'          => 'required|string',
            'descripcion'       => 'required|string',
            'comprobante'       => 'mimes:jpg,bmp,png,pdf'
        ]);

        $cargoGeneral = new CargoGeneral();

        $cargoGeneral->concepto     = $request->input('concepto');
        $cargoGeneral->descripcion  = $request->input('descripcion'); 
        $cargoGeneral->importe      = $request->input('importe');
        $cargoGeneral->fecha_inicio = $request->input('fecha_inicio');
        $cargoGeneral->periodicidad = $request->input('periodicidad');
        $cargoGeneral->repeticiones = $request->input('repeticiones');
        $cargoGeneral->descuento_por_desocupada = $request->input('descuento_por_desocupada');
        $cargoGeneral->created_by   = \Auth::user()->id; 
        $cargoGeneral->updated_by   = \Auth::user()->id; 

        if ($request->file('comprobante')) {
            $cargoGeneral->nombre_original = $request->file('comprobante')->getClientOriginalName();
            $cargoGeneral->archivo = $request->file('comprobante')->store('minutas');
        } 
        $cargoGeneral->save();
        return redirect()
                ->route('cargos-generales')
                ->with(['alert-success' => 'Cargo registrado. Recuerda generar el calendario para que se incluya en los siguientes estados de cuenta.']);
    }

    public function deleteCalendario($id) {

        $cargoGeneral   = CargoGeneral::find($id);        
        if ($cargoGeneral == null) {
            return redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'No existe la definici??n de cargos.']);
        } else if ($cargoGeneral->estatus !== 'planeado') {
            redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'El estado de la planeaci??n no permite que se elimine.']);
        }

        $cargoGeneral->cargos()->delete();
        $cargoGeneral->estatus = 'creado';
        $cargoGeneral->updated_by   = \Auth::user()->id; 
        $cargoGeneral->save();

        return redirect()
                ->route('cargos-generales')
                ->with(['alert-success' => 'Cuotas desplanificadas a todos los condominos.']);
    }

    public function createCalendario($id) {

        $cargoGeneral   = CargoGeneral::find($id);        
        if ($cargoGeneral == null) {
            return redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'No existe la definici??n de cargos.']);
        }
        $condominos     = Condomino::all();        
        foreach($condominos as $condomino) {
            $fechaCargo     = Carbon::createFromFormat('Y-m-d H:i:s', $cargoGeneral->fecha_inicio);

            for($i = 0; $i < $cargoGeneral->repeticiones; $i++) {
                $cargo = new Cargo();

                $cargo->fecha_vencimiento   = $fechaCargo->toDateTime();                
                if ($condomino->desocupada) {
                    $cargo->importe         = $cargoGeneral->importe * $cargoGeneral->descuento_por_desocupada / 100;
                } else {
                    $cargo->importe         = $cargoGeneral->importe;
                }
                $cargo->concepto            = $cargoGeneral->concepto;
                $cargo->created_by          = \Auth::user()->id; 
                $cargo->updated_by          = \Auth::user()->id; 
                $cargo->cargo_general_id    = $cargoGeneral->id;
                $cargo->condomino_id        = $condomino->id;

                $cargo->save();

                $fechaCargo = $fechaCargo->addMonths($cargoGeneral->periodicidad); 
            }
        }
        $cargoGeneral->estatus = 'planeado';
        $cargoGeneral->updated_by   = \Auth::user()->id; 
        $cargoGeneral->save();

        return redirect()
                ->route('cargos-generales')
                ->with(['alert-success' => 'Cuotas planificadas a todos los condominos.']);
    }

    public function getEdit($id) {
        $cargoGeneral   = CargoGeneral::find($id);        
        if ($cargoGeneral == null) {
            return redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'No existe la definici??n de cargos.']);
        } else if ($cargoGeneral->estatus !== 'creado') {
            return redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'El estado del cargo no permite su modifiaci??n.']);
        }
        return view('cargosrecurrentes.form', ['cargo' => $cargoGeneral]);
    }

    public function postEdit(Request $request, $id) {
     
        $validateData = $this->validate($request, [
            'fecha_inicio'      => 'required|date',
            'repeticiones'      => 'required|numeric|gt:0',
            'periodicidad'      => 'required|string',
            'importe'           => 'required|numeric|gt:0',
            'repeticiones'      => 'required|numeric|gte:0|lte:12',
            'concepto'          => 'required|string',
            'descripcion'       => 'required|string',
            'comprobante'       => 'mimes:jpg,bmp,png,pdf'
        ]);

        $cargoGeneral   = CargoGeneral::find($id);        
        if ($cargoGeneral == null) {
            return redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'No existe la definici??n de cargos.']);
        } else if ($cargoGeneral->estatus !== 'creado') {
            return redirect()
                ->route('cargos-generales')
                ->with(['alert-danger' => 'El estado del cargo no permite su modifiaci??n.']);
        }
        $cargoGeneral->concepto     = $request->input('concepto');
        $cargoGeneral->descripcion  = $request->input('descripcion'); 
        $cargoGeneral->importe      = $request->input('importe');
        $cargoGeneral->fecha_inicio = $request->input('fecha_inicio');
        $cargoGeneral->periodicidad = $request->input('periodicidad');
        $cargoGeneral->repeticiones = $request->input('repeticiones');
        $cargoGeneral->descuento_por_desocupada = $request->input('descuento_por_desocupada');
        $cargoGeneral->created_by   = \Auth::user()->id; 
        $cargoGeneral->updated_by   = \Auth::user()->id; 

        if ($request->file('comprobante')) {
            $cargoGeneral->nombre_original = $request->file('comprobante')->getClientOriginalName();
            $cargoGeneral->archivo = $request->file('comprobante')->store('minutas');
        } 
        $cargoGeneral->save();
        return redirect()
                ->route('cargos-generales')
                ->with(['alert-success' => 'Cargo registrado. Recuerda generar el calendario para que se incluya en los siguientes estados de cuenta.']);
    }
}
