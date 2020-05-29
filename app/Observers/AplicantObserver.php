<?php

namespace App\Observers;

use App\Aplicant;
use App\Events\PostulationOportunity;

class AplicantObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Aplicant  $user
     * @return void
     */
    public function created(Aplicant $aplicant)
    {
        event(new PostulationOportunity($aplicant));

    }

}