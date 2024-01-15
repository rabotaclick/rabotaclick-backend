<?php

namespace App\Helpers\Contracts;

use App\Events\Contracts\EventInterface;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;
}
