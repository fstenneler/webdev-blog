<?php

namespace app\controller\frontend;

use app\ControllerApp;

class ErrorController extends ControllerApp
{

    public function getView($error = '404')
    {

        return $this->app()->HTTPResponse()->generateView();
        
    }

}