<?php

namespace App\Controllers;

class SpotifyAuth extends BaseController
{
    public function index()
    {
        $this->setSpotifySession();
        $this->checkSpotifyState();
        $this->setSpotifyAuth();
        $this->setCodeIgniterSession();
        $this->setRedirectionToUserSpotify();
    }

    private function setSpotifySession(){
        $this->spotifySession = new \SpotifyWebAPI\Session(
            $_ENV['SPOTIFY_CLIENT_ID'],
            $_ENV['SPOTIFY_CLIENT_SECRET'],
            $_ENV['SPOTIFY_REDIRECT_CALLBACK']
        );
    }

    private function checkSpotifyState(){
        \Config\Services::session();
        $state = $_GET['state'];
        if ($state !== $_SESSION['spotifyStare']) {
            die('State mismatch');
        }
    }

    private function setSpotifyAuth(){
        $this->spotifySession->requestAccessToken($_GET['code']);
        $this->spotifyAccessToken = $this->spotifySession->getAccessToken();
        $this->spotifyRefreshToken = $this->spotifySession->getRefreshToken();
    }

    private function setCodeIgniterSession(){
        $_SESSION['spotifyAccessToken'] = $this->spotifyAccessToken;
        $_SESSION['spotifyRefreshToken'] = $this->spotifyRefreshToken;
    }

    private function setRedirectionToUserSpotify(){
        header('Location: user');
        die();
    }
      
}
