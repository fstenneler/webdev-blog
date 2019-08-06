<?php

namespace app\controller\frontend;

use app\ControllerApp;

class AboutController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->HTTPResponse()->generateView();

    }
          
}
