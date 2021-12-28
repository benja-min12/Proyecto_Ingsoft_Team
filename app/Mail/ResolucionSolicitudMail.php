<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResolucionSolicitudMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Resoluvcion de Solicitud';
    public $info;
    public $observacion;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($observacion,$data)
    {
        $this->observacion = $observacion;
        $this->info = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Resolucion de solicitud')->view('email.solicitudResolucion');
    }
}
