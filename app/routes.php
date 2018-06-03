<?php

$router->get($config['url_prefix'] . '', 'HomeController@index');
$router->get($config['url_prefix'] . 'register', 'RegisterController@index');
$router->post($config['url_prefix'] . 'register', 'RegisterController@store');
$router->get($config['url_prefix'] . 'login', 'LoginController@index');
$router->post($config['url_prefix'] . 'login', 'LoginController@login');
$router->get($config['url_prefix'] . 'logout', 'LoginController@logout');
$router->get($config['url_prefix'] . 'notes', 'NotesController@index');
$router->get($config['url_prefix'] . 'notes/create', 'NotesController@create');
$router->post($config['url_prefix'] . 'notes', 'NotesController@store');
$router->get($config['url_prefix'] . 'notes/delete', 'NotesController@destroy');
$router->get($config['url_prefix'] . 'notes/edit', 'NotesController@edit');
$router->post($config['url_prefix'] . 'notes/update', 'NotesController@update');