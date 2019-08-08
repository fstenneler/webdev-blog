<?php

namespace app\controller\frontend;

use app\ControllerApp;

class HomeController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView();

    }
          
}
