<?php

namespace app\controller\frontend;

use app\ControllerApp;

class HeaderController extends ControllerApp
{
 
    public function getView()
    {

        //infos user
        if($this->app()->user()->isAuthenticated()) {
            $this->app()->setData('user', $this->app()->httpRequest()->getSession('user'));

            $this->app()->setData('avatar', array(
                'firstLetter' => strtoupper(substr($this->app()->httpRequest()->getSession('user')->nickname,0,1)),
                'color' => $this->app()->httpRequest()->getSession('user')->avatar
            ));
        }

        //Deconnexion
        if($this->app()->httpRequest()->getData('action') === 'logout') {
            $this->app()->user()->setDisconnection();
        }

        return $this->app()->httpResponse()->generateView('header');

    }
          
}
