<?php

namespace app\controller\frontend;

use app\ControllerApp;

class HeaderController extends ControllerApp
{
 
    public function getView()
    {

        //Deconnexion
        if($this->app()->HTTPRequest()->getData('action') == 'logout') {
            $this->app()->user()->setDisconnection();
        }

        return $this->app()->HTTPResponse()->generateView('header');

    }
          
}
