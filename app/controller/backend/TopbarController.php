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

        $this->app()->setData('avatar', array(
            'firstLetter' => strtoupper(substr($this->app()->HTTPRequest()->getSession('user')->nickname,0,1)),
            'color' => $this->app()->HTTPRequest()->getSession('user')->avatar
        ));

        return $this->app()->HTTPResponse()->generateView('topbar');

    }
          
}
