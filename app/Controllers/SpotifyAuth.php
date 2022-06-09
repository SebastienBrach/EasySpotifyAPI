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
            'bbd636c28a7f4b9f875948046b3021f6',
            'f03f9ac87576486d82168c602fd7cea3',
            'http://localhost/auth'
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
