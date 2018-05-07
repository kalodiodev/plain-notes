<?php

function view($name, $data = [])
{
    extract($data);
    return require "app/views/{$name}.view.php";
}

function redirect($path)
{
    global $config;
    if($config['url_prefix'] != '') {
        header("Location: /". $config['url_prefix'] . '/' . "{$path}");
    } else {
        header("Location: /{$path}");
    }
}

function route($url)
{
    global $config;

    return '/' . $config['url_prefix'] . $url;
}