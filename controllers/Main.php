<?php

namespace controllers;

class Main extends \controllers\controller
{
    public function index()
    {
        $articleModel = $this->loadModel("Article" , "article");
        
        $view = $this->loadView();
        $view->start("index");
    }

    
}