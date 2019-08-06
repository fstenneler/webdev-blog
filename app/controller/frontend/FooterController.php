<?php

namespace app\controller\frontend;

use app\ControllerApp;

class FooterController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->HTTPResponse()->generateView('footer');

    }
          
}
