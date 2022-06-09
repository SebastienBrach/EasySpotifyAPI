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
            'bbd636c28a7f4b9f875948046b3021f6',
            'f03f9ac87576486d82168c602fd7cea3',
            'http://localhost/auth'
        );
    }

    private function setSpotifyState(){
        $this->spotifyState = $this->spotifySession->generateState();
    }

    private function setSpotifyOptions(){
        $this->spotifyOptions = [
            'scope' => [
                'ugc-image-upload',
                'user-modify-playback-state',
                'user-read-playback-state',
                'user-read-currently-playing',
                'user-follow-modify',
                'user-follow-read',
                'user-read-recently-played',
                'user-read-playback-position',
                'user-top-read',
                'playlist-read-collaborative',
                'playlist-modify-public',
                'playlist-read-private',
                'playlist-modify-private',
                'app-remote-control',
                'streaming',
                'user-read-private',
                'user-read-email',
                'user-library-modify',
                'user-library-read'
            ],
            'state' => $this->spotifyState,
        ];
    }

    private function setCodeIgniterSession(){
        \Config\Services::session();
        $_SESSION['spotifyStare'] = $this->spotifyState;
        // $_SESSION['spotifyOptions'] = $this->spotifyOptions;
    }

    private function setRedirectionToCallbackSpotify(){
        header('Location: ' . $this->spotifySession->getAuthorizeUrl($this->spotifyOptions));
        die();
    }
}
