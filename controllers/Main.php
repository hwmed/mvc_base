<?php

namespace controllers;

class Main extends \controllers\controller
{
    public function index()
    {
        $view = $this->loadView();
        $view->start("index");
    }
}