<?php

namespace app\controller\front;

use app\ControllerApp;

class ContactController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView();

    }
          
}
