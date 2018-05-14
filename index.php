<?php

ob_start();
session_start();

require 'vendor/autoload.php';

use App\Core\Database\Database;
use App\Core\Router;
use App\Core\Request;

$router = new Router();

$config = require './configuration.php';
require './app/routes.php';

$db = (new Database())->connect();

$router->direct(Request::uri(), Request::method());