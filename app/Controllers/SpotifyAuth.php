<?php

namespace App\Controllers;

class SpotifyAuth extends BaseController
{
    public function index()
    {
        \Config\Services::session();

        $session = new \SpotifyWebAPI\Session(
            'bbd636c28a7f4b9f875948046b3021f6',
            'f03f9ac87576486d82168c602fd7cea3',
            'http://localhost/auth'
        );

        $state = $_GET['state'];
        if ($state !== $_SESSION['state']) {
            die('State mismatch');
        }
        
        $session->requestAccessToken($_GET['code']);
        $_SESSION['accessToken'] = $session->getAccessToken();
        $_SESSION['refreshToken'] = $session->getRefreshToken();
        header('Location: user');
        die();
    }
}
