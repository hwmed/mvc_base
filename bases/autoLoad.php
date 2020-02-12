<?php

function __autoload($className)
{
    global $config;
    $dir = $config['root'] . $className . '.php';
    $dir = str_replace("\\" , "/" , $dir);
    if(file_exists($dir))
    {
        require_once $dir;
    }
    else
        throw new Exception('file ' . $className . ' not exist');
}