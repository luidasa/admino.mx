<?php

namespace App\Mail;

use App\Models\Colaborador;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitarColaboradorEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Colaborador $invitacion)
    {
        $this->invitacion = $invitacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.invitar_colaborador', ['invitacion' => $this->invitacion]);
    }
}
