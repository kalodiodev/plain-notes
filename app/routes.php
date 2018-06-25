<?php

$router->get($config['url_prefix'] . '404', 'ErrorController@not_found');
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
$router->get($config['url_prefix'] . 'settings', 'SettingsController@index');
$router->post($config['url_prefix'] . 'user/info_update', 'UserController@info_update');
$router->post($config['url_prefix'] . 'user/password_update', 'UserController@password_update');
$router->post($config['url_prefix'] . 'user/delete_account', 'UserController@delete_account');
$router->get($config['url_prefix'] . 'admin/users', 'AdminUserController@index');
$router->get($config['url_prefix'] . 'confirm', 'RegisterController@confirm');
$router->get($config['url_prefix'] . 'forgot-password', 'ForgotPasswordController@index');
$router->post($config['url_prefix'] . 'forgot-password', 'ForgotPasswordController@sendToken');