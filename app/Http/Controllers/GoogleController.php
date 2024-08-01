<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Service\Action\AddEventAction;
use App\Service\Action\DeleteEventAction;
use App\Service\Action\GetAllEventAction;
use App\Service\Action\UserAction;
use App\Service\GoogleService;
use Google_Service_Oauth2;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function login(GoogleService $googleService): RedirectResponse
    {
        $client = $googleService->getClient();
        $url = $client->createAuthUrl();

        return redirect()->away($url);
    }

    public function getAllEvents(GetAllEventAction $action): View|Factory|Application
    {
        $events = $action->execute();

        return view('events', compact('events'));
    }

    public function callback(Request $request, GoogleService $googleService, UserAction $userAction): RedirectResponse
    {
        $client = $googleService->getClient();
        $code = $request->get('code');
        $token = $client->fetchAccessTokenWithAuthCode($code);
        $refreshToken = $token['refresh_token'];

        $oauth2 = new Google_Service_Oauth2($client);
        $userinfo = $oauth2->userinfo->get();

        $user = $userAction->run($userinfo, $refreshToken);
        Auth::login($user);

        return redirect()->route('create-event');
    }

    public function createEvent(): View|Factory|Application
    {
        return view('index');
    }

    public function storeEvent(EventRequest $request, AddEventAction $addEventAction): RedirectResponse
    {
        $eventData = $request->all();
        $addEventAction->run($eventData);

        return redirect()->route('event')->with(['success' => 'Your event was successfully added!']);
    }
    public function deleteEvent(Request $request, DeleteEventAction $deleteEventAction)
    {
        $data = $request->input('val');
        $deleteEventAction->run($data);

        return response()->json(['success' => true]);

    }
}
