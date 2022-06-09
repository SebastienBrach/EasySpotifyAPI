<?php

namespace App\Controllers;

class SpotifyEntrypoint extends BaseController
{
    public function index()
    {
        $this->setSpotifySession();
        $this->setSpotifyState();
        $this->setSpotifyOptions();
        $this->setCodeIgniterSession();
        $this->setRedirectionToCallbackSpotify();
    }

    private function setSpotifySession(){
        $this->spotifySession = new \SpotifyWebAPI\Session(
            $_ENV['SPOTIFY_CLIENT_ID'],
            $_ENV['SPOTIFY_CLIENT_SECRET'],
            $_ENV['SPOTIFY_REDIRECT_CALLBACK']
        );
    }

    private function setSpotifyState(){
        $this->spotifyState = $this->spotifySession->generateState();
    }

    private function setSpotifyOptions(){
        $this->spotifyOptions = [
            'scope' => [$_ENV['SPOTIFY_SCOPES']],
            'state' => $this->spotifyState,
        ];
    }

    private function setCodeIgniterSession(){
        \Config\Services::session();
        $_SESSION['spotifyStare'] = $this->spotifyState;
    }

    private function setRedirectionToCallbackSpotify(){
        header('Location: ' . $this->spotifySession->getAuthorizeUrl($this->spotifyOptions));
        die();
    }
}
