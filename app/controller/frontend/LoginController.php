<?php

namespace app\controller\frontend;

use app\model\UserModel;
use app\ControllerApp;

class LoginController extends ControllerApp
{
 
    public function getView()
    {

        if($this->app()->user()->setAuthentification($this->app()->httpRequest()->postData('cEmail'), $this->app()->httpRequest()->postData('cPassword')) === false) {
            $this->app()->setData('email', $this->app()->httpRequest()->postData('cEmail'));
            $this->app()->setData('formError', 'L\'adresse e-mail ou le mot de passe saisis sont erronés.');
        }

        return $this->app()->httpResponse()->generateView();

    }
          
}
