<?php

namespace app\controller\backend;

use app\ControllerApp;

class PostController extends ControllerApp
{
 
    public function getView()
    {

        $pageName = $this->app()->getPageName() . $this->app()->HTTPRequest()->getData('action');
        return $this->app()->HTTPResponse()->generateView($pageName);

    }
          
}
