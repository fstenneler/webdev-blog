<?php

namespace app\controller\frontend;

use app\ControllerApp;

class HeaderController extends ControllerApp
{
 
    public function getView()
    {

        //infos user
        $this->app()->setData('user', $this->app()->HTTPRequest()->getSession('user'));

        $this->app()->setData('avatar', array(
            'firstLetter' => strtoupper(substr($this->app()->HTTPRequest()->getSession('user')->nickname,0,1)),
            'color' => $this->app()->HTTPRequest()->getSession('user')->avatar
        ));

        //Deconnexion
        if($this->app()->HTTPRequest()->getData('action') == 'logout') {
            $this->app()->user()->setDisconnection();
        }

        return $this->app()->HTTPResponse()->generateView('header');

    }
          
}
