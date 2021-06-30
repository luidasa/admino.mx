<?php

namespace App\Http\Controllers;

use App\Mail\InvitarColaboradorEmail;
use App\Models\Colaborador;
use App\Models\Condomino;
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

    public function getDesinvitar($condominio_id, $id) {

        $mensaje = 'La invitación a colaborar ha sido retirada;';
        $colaborador = Colaborador::findOrFail($id);
        if ($colaborador->role == 'Administrador') {
            $colaborador->delete();
        } else {
            $colaborador->role = 'Residente';
            $colaborador->save();
            $mensaje = 'La invitación a colaborar ha sido retirada. El colaborador solo se puede quedar como Residente';
        }
        return redirect()
            ->route('edit-condominio', ['id' => $condominio_id])
            ->with(['alert-success' => $mensaje]);

    }

    public function postEdit(Request $request, $condominio_id, $id) {

        $this->validate($request, [
            'role' => 'required|string'
        ]);

        $colaborador = Colaborador::findOrFail($id);
        $colaborador->role = $request->input('role');
        $colaborador->save();
        return redirect()
            ->route('edit-condominio', ['id' => $condominio_id])
            ->with(['alert-success' => 'El role del colaborador ha sido modificado;']);
    }
}
