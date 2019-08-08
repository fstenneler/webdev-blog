<?php

namespace app\lib;

class Route extends ApplicationComponent
{

    public function setRoute($url)
    {
        if($url !== $this->app()->httpRequest()->requestURI() && $url !== null) {
            header('Location: ' . $url);
            return true;
        }
        return false;
    }

    public function setLastRoute() 
    {
        if(strtolower($this->app()->getPageName()) !== 'login' && strtolower($this->app()->getPageName()) !== 'signup' && strtolower($this->app()->getPageName()) !== 'account' && $this->app()->httpRequest()->getExists('action') === false) {
            $this->app()->httpRequest()->setSession('lastZoneName', $this->app()->getZoneName());
            $this->app()->httpRequest()->setSession('lastUrl', $this->app()->httpRequest()->requestURI());
        } 
    }

    public function setBackendAccess() 
    {
        if($this->app()->user()->isAuthenticated() === false) {
            return $this->setRoute('/index.php?page=login');
        } elseif($this->app()->httpRequest()->getSession('user')->role !== 'Administrateur') {
            if($this->app()->httpRequest()->getSession('lastUrl') !== null && $this->app()->httpRequest()->getSession('lastZoneName') !== 'backend') {
                return $this->setRoute($this->app()->httpRequest()->getSession('lastUrl'));
            }
            return $this->setRoute('/index.php');
        }
    }

}
