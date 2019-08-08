<?php

namespace app\controller\backend;

use app\ControllerApp;

class ErrorController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView();

    }
          
}
