<?php

namespace App\Controllers;

class SpotifyEntrypoint extends BaseController
{
    public function index()
    {
        \Config\Services::session();
        $session = new \SpotifyWebAPI\Session(
            'bbd636c28a7f4b9f875948046b3021f6',
            'f03f9ac87576486d82168c602fd7cea3',
            'http://localhost/auth'
        );

        $_SESSION['state'] = $session->generateState();
        $_SESSION['options'] = [
            'scope' => [
                'playlist-read-private',
                'user-read-private',
            ],
            'state' => $_SESSION['state'],
        ];

        header('Location: ' . $session->getAuthorizeUrl($_SESSION['options']));
        die();
    }
}
