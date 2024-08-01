<?php

namespace App\Service;

use Google\Client;
use Google_Service_Calendar;
use Google_Service_Oauth2;

class GoogleService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName(config('app.name'));
        $this->client->setClientId(config('google.client_id'));
        $this->client->setClientSecret(config('google.client_secret'));
        $this->client->setRedirectUri(config('google.redirect_uri'));

        $this->client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $this->client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);
        $this->client->addScope(Google_Service_Calendar::CALENDAR);

        $this->client->setPrompt('consent');
        $this->client->setAccessType('offline');
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
