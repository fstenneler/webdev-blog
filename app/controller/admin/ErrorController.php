<?php

namespace app\controller\admin;

use app\ControllerApp;

class ErrorController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView();

    }
          
}
