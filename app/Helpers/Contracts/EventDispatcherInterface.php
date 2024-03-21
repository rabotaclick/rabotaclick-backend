<?php declare(strict_types=1);
namespace App\Helpers\Contracts;

use App\Events\Contracts\EventInterface;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;
}
