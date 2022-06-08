<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = new SpotifyWebAPI\Session(
            'CLIENT_ID',
            'CLIENT_SECRET',
            'REDIRECT_URI'
        );
        return view('welcome_message');
    }
}
