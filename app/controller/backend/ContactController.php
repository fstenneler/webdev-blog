<?php

namespace app\controller\backend;

use app\ControllerApp;

class ContactController extends ControllerApp
{
 
    public function getView()
    {

        $pageName = $this->app()->getPageName() . $this->app()->HTTPRequest()->getData('action');
        return $this->app()->HTTPResponse()->generateView($pageName);

    }
          
}
