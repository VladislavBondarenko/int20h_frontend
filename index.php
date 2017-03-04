<?php
/**
 * Created by PhpStorm.
 * User: kalim_000
 * Date: 3/3/2017
 * Time: 11:09 PM
 */

session_start();

require_once('vendor\autoload.php');

use app\components\Server;

$params = require('config/config.php');

//$_SESSION['access_token'] = 'ecff8f00b4fd0029c8963bca2fa780f2074c947d8db76bb4009e8e3b0d5cf5f90ae8e8f388dbfe3a5489c';

//unset($_SESSION['access_token']);

$server = new Server($params['serverParams']);

if (!isset($_SESSION['access_token'])) {
    if (!isset($_REQUEST['code'])) {
        $authorize_url = $server->post('api/auth/auth-vk', [
            'scope' => 'groups'
        ]);
        //    print_r($authorize_url); die;
        echo '<a href="' . $authorize_url->authUri . '">Sign in with VK</a>';
    } else {
        $accessToken = $server->post('api/auth/auth-vk', [
            'code' => $_REQUEST['code']
        ]);
        $_SESSION['access_token'] = $accessToken->accessToken;

        print_r($accessToken);
    }
}
else{
    $user = $server->get('api/auth/friends', [
        'access_token' => $_SESSION['access_token']
    ]);
    print_r($user);
}
