<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSend extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $contenido;
    public $correo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo,$contenido,$correo)
    {
        //
        $this->subject = $titulo;
        $this->contenido = $contenido;
        $this->correo = $correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail');
    }
}
