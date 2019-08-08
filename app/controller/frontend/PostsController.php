<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\controller\frontend\ErrorController;

class PostsController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView();

    }
          
}
