<?php

namespace App\Listeners;

abstract class EventSubscriber
{
    /**
     * @param $events
     * @return void
     */
    abstract public function subscribe($events): void;
}
