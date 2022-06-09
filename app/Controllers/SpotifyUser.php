<?php

namespace App\Controllers;

class SpotifyUser extends BaseController
{
    public function index()
    {
        $this->setSpotifyAccessToken();
        $this->getUserData();
    }

    private function setSpotifyAccessToken(){
        \Config\Services::session();
        $this->spotifyAccessToken = $_SESSION['spotifyAccessToken'];
        $this->spotifyAPI = new \SpotifyWebAPI\SpotifyWebAPI();
        $this->spotifyAPI->setAccessToken($this->spotifyAccessToken);
    }
    
    private function getUserData(){
        echo '<pre>';
        // var_dump($this->spotifyAPI->me());
        var_dump($this->spotifyAPI->getMyDevices());
        var_dump($_ENV);
        // var_dump($this->spotifyAPI->getTrack('4uLU6hMCjMI75M1A2tKUQC'));
        echo '</pre>';
    }
}
