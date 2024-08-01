<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EventRepository
{
    protected function query(): Builder
    {
        return Event::query();
    }

    public function getAll(): Collection
    {
        return $this->query()->get();
    }

    public function createEvent(array $data,string $eventId): Event
    {
        return $this->query()->create([
            'user_id'=> auth()->user()->id,
            'event_id' => $eventId,
            'summary' => $data['title'],
            'description' => $data['description'],
            'start' => $data['start'],
            'end' => $data['end'],
        ]);
    }
    public function delete(string $eventId)
    {
        return $this->query()->where('event_id', $eventId)->delete();
    }
}
