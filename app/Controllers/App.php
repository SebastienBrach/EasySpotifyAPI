<?php

namespace App\Controllers;

class App extends BaseController
{
    public function index()
    {
        \Config\Services::session();
        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($_SESSION['accessToken']);
        print_r(
            $api->me()
        );
        print_r(
            $api->getTrack('7EjyzZcbLxW7PaaLua9Ksb')
        );
        // return view('app');
    }
}
