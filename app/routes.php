<?php

$router->get($config['url_prefix'] . '', 'HomeController@index');
$router->get($config['url_prefix'] . 'register', 'RegisterController@index');
$router->post($config['url_prefix'] . 'register', 'RegisterController@store');