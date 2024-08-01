<?php

namespace App\Service\Action;

use App\Repositories\EventRepository;
use App\Service\GoogleCalendarService;

class DeleteEventAction
{
    protected EventRepository $eventRepository;
    protected GoogleCalendarService  $googleCalendarService;

    public function __construct(EventRepository $eventRepository,GoogleCalendarService $googleCalendarService)
    {
        $this->eventRepository = $eventRepository;
        $this->googleCalendarService = $googleCalendarService;
    }

    public function run(string $eventId)
    {
        $client  = $this->googleCalendarService->getClient();

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken(auth()->user()->refresh_token);
            $accessToken = $client->getAccessToken();
            $client->setAccessToken($accessToken);
        }
        $this->googleCalendarService->deleteEvent($eventId);
        $this->eventRepository->delete($eventId);
    }
}
