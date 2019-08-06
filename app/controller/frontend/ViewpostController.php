<?php

namespace app\controller\frontend;

use app\ControllerApp;

class ViewpostController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->HTTPResponse()->generateView();

    }
          
}
