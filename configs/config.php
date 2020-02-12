<?php

$config = array(
    "base_url" => "http://locahost/mvc_base",
    "def_class" => "Main",
    "def_error_class" => "Error",
    "root" => str_replace("index.php", "" , $_SERVER['SCRIPT_FILENAME'])
);

define('BASE_URL', $config['base_url']);