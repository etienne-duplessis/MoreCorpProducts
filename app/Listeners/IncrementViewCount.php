<?php

namespace App\Listeners;

use App\Events\ViewCount;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementViewCount
{
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
     * @param  ViewCount  $event
     * @return void
     */
    public function handle(ViewCount $event)
    {
        $product = $event->product;

        $product->view_count = $product->view_count + 1;

        $product->save();

    }
}
