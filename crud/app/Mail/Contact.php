<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable{
    use Queueable, SerializesModels;

    public $mensaje;//objeto que contendra toda la info

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje){
        $this->mensaje=$mensaje;
    }

    //*buil the message.
    public function build(){

       // dd($this->view('emails.contact'));
        return $this->from($this->mensaje->email)
                    ->subject('Mensaje recibido: '.$this->mensaje->asunto)
                    ->with('centro','CIFO Sabadell')
                    ->view('emails.contact');

                    //si hay un fichero, lo adjuntamos
                    if($this->mensaje->fichero)
                        $email->attach($this->mensaje->fichero,[
                            'as' => 'adjunto_'.uniqid().'.pdf', //nombre unico
                            'mime' => 'application/pdf',
                        ]);
                        return $email;
    }
    
    
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contact',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.contact',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
