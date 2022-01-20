<?php

namespace app\controllers;


class MainController{
    public function indexAction(){
        echo 'main' . '<br>';
        echo __METHOD__;
    }
}