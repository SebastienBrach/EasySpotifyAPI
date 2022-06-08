<?php

namespace App\Controllers;

class Spotify extends BaseController
{
    public function index()
    {
        \Config\Services::session();

        $session = new \SpotifyWebAPI\Session(
            'bbd636c28a7f4b9f875948046b3021f6',
            'f03f9ac87576486d82168c602fd7cea3',
            'http://localhost/callback'
        );

        $state = $_GET['state'];
        if ($state !== $_SESSION['state']) {
            die('State mismatch');
        }

        // try {
            $session->requestAccessToken($_GET['code']);
            $_SESSION['accessToken'] = $session->getAccessToken();
            $_SESSION['refreshToken'] = $session->getRefreshToken();
            // header('Location: http://localhost/App');
            header('Location: App');
            die();

        // } catch (Exception $e){
        //     header('Location: ' . $session->getAuthorizeUrl($_SESSION['options']));
        // }
        
        // print_r($api->getTrack('7EjyzZcbLxW7PaaLua9Ksb'));
        // return view('app');

        // die();

    }
}
