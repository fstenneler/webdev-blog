<?php

namespace app\controller\frontend;

use app\ControllerApp;

class ErrorController extends ControllerApp
{

    public function getView()
    {

        return $this->app()->httpResponse()->generateView();
        
    }

}
