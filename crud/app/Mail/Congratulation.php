<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Planta;

class Congratulation extends Mailable{
    use Queueable, SerializesModels;
    public $planta;

    public function __construct(Planta $planta){
        $this->planta = $planta;
    }

    public function build(){
        return $this->from('no-replay@laraplantas.com')
                    ->subject('¡Felicidades!')
                    ->view('emails.congratulation');
    }
}
