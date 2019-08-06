<?php

namespace app\controller\frontend;

use app\ControllerApp;

class HeaderController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->HTTPResponse()->generateView('header');

    }
          
}
