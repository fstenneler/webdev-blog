<?php

namespace app\controller\backend;

use app\ControllerApp;

class UserController extends ControllerApp
{
 
    public function getView()
    {

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
