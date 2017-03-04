<?php
/**
 * Created by PhpStorm.
 * User: kalim_000
 * Date: 3/3/2017
 * Time: 11:09 PM
 */

require_once ('vendor\autoload.php');

use app\components\Server;

$params = require ('config/config.php');

$server = new Server($params['serverParams']);

$users = $server->get('api/user', []);

print_r($users);