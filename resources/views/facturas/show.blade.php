@extends('layouts.master')

@section('titulo', 'Registro de cuotas de condominos')

@section('encabezado')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Estado de Cuenta al {{ date('d/M/Y', strtotime($factura->fecha_corte)) }}</h1>
</div>
@endsection

@section('camino')
@endsection

@section('feedback')
  @parent
@endsection

@section('contenido')

<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>

    <hr>
    <div class="row">
      <div class="col">
        <address>
        <strong>Facturado por:</strong><br>
          Asociación de Condominos de la Privada 110 de Villas Fontana II<br>
          Cerrada de Monte Sacro 110<br>
          Villas Fontana II<br>
          Queretaro, Queretaro. Cp. 76148
        </address>
      </div>
      <div class="col text-right">
        <address>
          <strong>Condómino:</strong><br>
          {{ $factura->condomino->duenio }}<br>
          1234 Main<br>
          Apt. 4B<br>
          Springfield, ST 54321
        </address>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <address>
        <strong>Periodo: </strong>{{ date('d/m/Y', strtotime($factura->fecha_inicio)) }} al {{ date('d/m/Y', strtotime($factura->fecha_corte)) }}<br>
        <strong>Saldo actual: </strong>{{ $factura->saldo_actual }}<br>
        <strong>Paguese antes de: </strong> {{ date('d/m/Y', strtotime($factura->fecha_vencimiento)) }}<br>
        <strong>Saldo inicial: </strong>{{ $factura->saldo_anterior }}<br>
        </address>
      </div>
      <div class="col text-right">
        <address>
          <strong>Entrega:</strong><br>
          <strong>Email: </strong>{{ $factura->condomino->email }}<br>
          <strong>Teléfono: </strong>{{ $factura->condomino->telefono }}
        </address>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Resumen de movimientos</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                    <tr>
        							<td><strong>Fecha</strong></td>
        							<td class="text-center"><strong>Concepto</strong></td>
        							<td class="text-center"><strong>Importe</strong></td>
        							<td class="text-right"><strong>Saldo</strong></td>
                    </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                  @php 
                    $saldo = $factura->saldo_anterior 
                  @endphp
                  @foreach($factura->items_pagos as $pago)
    							<tr>
    								<td>{{ date('d/m/Y', strtotime($pago->pagado_el)) }}</td>
    								<td class="text-left">{{ $pago->referencia }}</td>
    								<td class="text-right">- {{ $pago->importe }}</td>
    								<td class="text-right">{{ $saldo -= $pago->importe }}</td>
    							</tr>
                  @endforeach
                  @foreach($factura->items_cargos as $cargo)
    							<tr>
    								<td>{{ date('d/m/Y', strtotime($cargo->created_at)) }}</td>
    								<td class="text-left">{{ $cargo->concepto }} {{ $cargo->descripcion }}</td>
    								<td class="text-right">{{ $cargo->importe }}</td>
    								<td class="text-right">{{ $saldo += $cargo->importe }}</td>
    							</tr>
                  @endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-right"><strong>Total de cargos:</strong></td>
    								<td class="thick-line text-right">{{ $factura->cargos }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>Total de pagos:</strong></td>
    								<td class="no-line text-right">- {{ $factura->abonos }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-right"><strong>Total</strong></td>
    								<td class="no-line text-right">{{ $factura->saldo_actual }}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

@endsection

