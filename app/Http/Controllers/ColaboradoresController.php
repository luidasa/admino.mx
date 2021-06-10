<?php

namespace App\Http\Controllers;

use App\Mail\InvitarColaboradorEmail;
use App\Models\Colaborador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ColaboradoresController extends Controller
{
    public function postInvitar(Request $request, $condominio_id) {

        // Validamos que esten bien formados los datos, el email y el puesto.
        $this->validate($request, [
            'invitar-permisos'  => 'required|string',
            'invitar-email'     => 'required|email'
        ]);

        $invitacion = new Colaborador();
        $invitacion->destinatario       = $request->input('invitar-email');
        $invitacion->fecha_expiracion   = Carbon::now()->addDays(7);
        $invitacion->role               = $request->input('invitar-permisos');
        $invitacion->condominio_id      = $condominio_id;
        $invitacion->remitente_id       = Auth::user()->id;

        $invitacion->save();

        Mail::to($invitacion->destinatario)
            ->send(new InvitarColaboradorEmail($invitacion));

        return redirect()
            ->route('edit-condominio', ['id' => $condominio_id])
            ->with(['alert-success' => 'Invitación enviada.']);
    }
}
