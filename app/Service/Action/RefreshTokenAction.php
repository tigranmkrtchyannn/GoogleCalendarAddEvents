<?php

namespace App\Service\Action;

use App\Repositories\CalendarRepository;
use Google_Client;

class RefreshTokenAction
{
    protected CalendarRepository $repository;
    public function __construct(CalendarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): Google_Client
    {
        $client = $this->repository->getClient();
        $refreshToken = $this->repository->refreshToken();

        if ($refreshToken) {
            $client->refreshToken($refreshToken);
        }

        return $client;
    }
}
