<?php
/**
 * Created by PhpStorm.
 * User: kalim_000
 * Date: 3/3/2017
 * Time: 11:09 PM
 */
session_start();
ini_set('error_reporting', 0);
error_reporting( 0);
require_once('vendor\autoload.php');

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT',dirname(__FILE__));

use app\components\Router;

$router = new Router();
$router->run();

