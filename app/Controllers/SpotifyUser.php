<?php

namespace App\Controllers;

class SpotifyUser extends BaseController
{
    public function index()
    {
        \Config\Services::session();
        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($_SESSION['spotifyAccessToken']);
        echo '<pre>';
        var_dump($api->me());
        echo '</pre>';
    }
}
