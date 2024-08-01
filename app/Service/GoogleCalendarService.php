<?php

namespace App\Service;

use Google\Service\Calendar\Event;
use Google_Service_Calendar;

class GoogleCalendarService extends GoogleService
{
    protected Google_Service_Calendar $calendarService;

    public function __construct()
    {
        parent::__construct();
        $this->calendarService = new Google_Service_Calendar($this->client);
    }

    public function createEvent(array $eventData): Event
    {
        $event = new Event([
            'summary' => $eventData['title'],
            'description' => $eventData['description'],
            'start' => [
                'dateTime' => $eventData['start'],
                'timeZone' => 'Asia/Yerevan',
            ],
            'end' => [
                'dateTime' => $eventData['end'],
                'timeZone' => 'Asia/Yerevan',
            ]
        ]);
        $calendarId = 'primary';
        return $this->calendarService->events->insert($calendarId, $event);
    }

    public function deleteEvent(string $eventId)
    {
        $calendarId = 'primary';
        return $this->calendarService->events->delete($calendarId, $eventId);
    }

}
