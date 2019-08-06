<?php

namespace app\controller\backend;

use app\ControllerApp;

class TopbarController extends ControllerApp
{
 
    public function getView()
    {
        
        if($this->app()->HTTPRequest()->getData('logout') == 'true') {
            $this->app()->user()->setDisconnection();
            header('Location: /index.php?page=login');
            exit();
        }

        return $this->app()->HTTPResponse()->generateView('topbar');

    }
          
}
