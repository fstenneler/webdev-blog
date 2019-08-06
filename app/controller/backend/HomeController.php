<?php

namespace app\controller\backend;

use app\ControllerApp;

class HomeController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->HTTPResponse()->generateView();

    }
          
}
