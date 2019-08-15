<?php

namespace app\controller\admin;

use app\ControllerApp;

class NavbarController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView('navbar');

    }
          
}
