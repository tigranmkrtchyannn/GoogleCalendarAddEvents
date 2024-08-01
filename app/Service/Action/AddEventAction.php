<?php

namespace App\Service\Action;;
use App\Repositories\EventRepository;
use App\Service\GoogleCalendarService;
use App\UseCases\TimeParseUseCase;
class AddEventAction
{
    protected EventRepository $eventRepository;
    protected TimeParseUseCase $timeParseUseCase;
    protected GoogleCalendarService  $googleCalendarService;
    public function __construct(
        EventRepository $eventRepository,
        TimeParseUseCase $timeParseUseCase,
        GoogleCalendarService $googleCalendarService  )
    {
        $this->eventRepository = $eventRepository;
        $this->timeParseUseCase = $timeParseUseCase;
        $this->googleCalendarService =  $googleCalendarService;
    }

    public function run(array $data)
    {
        $startTime = $this->timeParseUseCase->execute($data['start']);
        $endTime = $this->timeParseUseCase->execute($data['end']);
        $client =  $this->googleCalendarService->getClient();

        if($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken(auth()->user()->refresh_token);
            $accessToken = $client->getAccessToken();
            $client->setAccessToken($accessToken);
        }

        $data['start'] = $startTime;
        $data['end'] = $endTime;

        $insertedEvent = $this->googleCalendarService->createEvent($data);
        $this->eventRepository->createEvent($data, $insertedEvent->id);
    }
}
