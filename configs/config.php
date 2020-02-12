<?php

$config = array(
    "base_url" => "http://locahost/mvc_base",
    "def_class" => "Main",
    "def_error_class" => "Error",
    "root" => str_replace("index.php", "" , $_SERVER['SCRIPT_FILENAME']),
    "db_host" => "localhost",
    "db_name" => "shop",
    "db_user" => "root",
    "db_pass" => ""
);

define('BASE_URL', $config['base_url']);