<?php

namespace App\Observers;

use App\NegotiationProcess;
use Carbon\Carbon;

class NegotiationProcessObserver
{
    /**
     * Handle the negotiation process "created" event.
     *
     * @param  \App\NegotiationProcess  $negotiationProcess
     * @return void
     */
    public function created(NegotiationProcess $negotiationProcess)
    {
        foreach ($negotiationProcess->negotiations as $negotiation) {
            $negotiation->won_status_date = $negotiationProcess->conversion === 1 ? Carbon::now() : null;
            $negotiation->save();
        }
    }

    /**
     * Handle the negotiation process "updated" event.
     *
     * @param  \App\NegotiationProcess  $negotiationProcess
     * @return void
     */
    public function updated(NegotiationProcess $negotiationProcess)
    {
        foreach ($negotiationProcess->negotiations as $negotiation) {
            $negotiation->won_status_date = $negotiationProcess->conversion === 1 ? Carbon::now() : null;
            $negotiation->save();
        }
    }

    /**
     * Handle the negotiation process "deleted" event.
     *
     * @param  \App\NegotiationProcess  $negotiationProcess
     * @return void
     */
    public function deleted(NegotiationProcess $negotiationProcess)
    {
        //
    }

    /**
     * Handle the negotiation process "restored" event.
     *
     * @param  \App\NegotiationProcess  $negotiationProcess
     * @return void
     */
    public function restored(NegotiationProcess $negotiationProcess)
    {
        //
    }

    /**
     * Handle the negotiation process "force deleted" event.
     *
     * @param  \App\NegotiationProcess  $negotiationProcess
     * @return void
     */
    public function forceDeleted(NegotiationProcess $negotiationProcess)
    {
        //
    }
}
