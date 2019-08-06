<?php

namespace app\lib;

class Route extends ApplicationComponent
{

    public function setRoute($url)
    {
        header('Location: ' . $url);
        exit();
    }

    public function setLastRoute() 
    {
        if(strtolower($this->app()->getPageName()) != 'login' && $this->app()->HTTPRequest()->getExists('action') == false) {
            $_SESSION['lastZoneName'] = $this->app()->getZoneName();
            $_SESSION['lastUrl'] = $this->app()->HTTPRequest()->requestURI();
        } 
    }

    public function setBackendAccess() 
    {
        if($this->app()->user()->isAuthenticated() == false) {
            $this->setRoute('/index.php?page=login');
        } elseif($this->app()->HTTPRequest()->getSession('user')->role != 'Administrateur') {
            if($this->app()->HTTPRequest()->getSession('lastUrl') != null && $this->app()->HTTPRequest()->getSession('lastZoneName') != 'backend') {
                $this->setRoute($this->app()->HTTPRequest()->getSession('lastUrl'));
            } else {
                $this->setRoute('/index.php');
            }
        }
    }

}