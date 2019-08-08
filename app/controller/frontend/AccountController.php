<?php

namespace app\controller\frontend;

use app\model\UserModel;
use app\ControllerApp;

class AccountController extends ControllerApp
{
 
    public function getView()
    {

        return $this->app()->httpResponse()->generateView();

    }
          
}
