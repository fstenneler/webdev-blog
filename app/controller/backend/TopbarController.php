<?php

namespace app\controller\backend;

use app\ControllerApp;

class TopbarController extends ControllerApp
{
 
    public function getView()
    {
        
        if($this->app()->httpRequest()->getData('logout') === 'true') {
            $this->app()->user()->setDisconnection();
            return $this->app()->route()->setRoute('/index.php?page=login');
        }

        $this->app()->setData('avatar', array(
            'firstLetter' => strtoupper(substr($this->app()->httpRequest()->getSession('user')->nickname,0,1)),
            'color' => $this->app()->httpRequest()->getSession('user')->avatar
        ));

        return $this->app()->httpResponse()->generateView('topbar');

    }
          
}
