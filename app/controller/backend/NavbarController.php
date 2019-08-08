<?php

namespace app\controller\backend;

use app\ControllerApp;

class NavbarController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView('navbar');

    }
          
}
