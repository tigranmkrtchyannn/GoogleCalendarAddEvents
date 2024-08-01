<?php

namespace App\Service\Action;

use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllEventAction
{
    protected EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

        public function execute(): Collection
        {
            return $this->eventRepository->getAll();
        }
}
