<?php

ob_start();
session_start();

require 'vendor/autoload.php';

use App\Core\Router;
use App\Core\Request;


$router = new Router();
$router->direct(Request::uri(), Request::method());