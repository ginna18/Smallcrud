<?php

namespace App\Listeners;

use App\Events\FirstPlantaCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Congratulation;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\New_;

class SendCongratulationEmail{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FirstPlantaCreated  $event
     * @return void
     */
    public function handle(FirstPlantaCreated $event){
        Mail::to($event->user->email)->send(new Congratulation($event->planta));//
    }
}
