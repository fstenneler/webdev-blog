<?php

namespace app\lib;

class Route extends ApplicationComponent
{

    public function setRoute($url)
    {
        header('Location: ' . $url);
        return true;
    }

    public function setLastRoute() 
    {
        if(
            strtolower($this->app()->getPageName()) === 'home'
            || (strtolower($this->app()->getPageName()) === 'user' && $this->app()->httpRequest()->getData('action') === 'account')
            || strtolower($this->app()->getPageName()) === 'posts'
            || strtolower($this->app()->getPageName()) === 'viewpost'
            || strtolower($this->app()->getPageName()) === 'contact'
            || strtolower($this->app()->getPageName()) === 'privacy'
            || strtolower($this->app()->getPageName()) === 'about'
            || strtolower($this->app()->getZoneName()) === 'admin'
        ) {
            $this->app()->httpRequest()->setSession('lastZoneName', $this->app()->getZoneName());
            $this->app()->httpRequest()->setSession('lastUrl', $this->app()->httpRequest()->requestURI());
        } 
    }

    public function setBackendAccess() 
    {
        if($this->app()->user()->isAuthenticated() === false) {
            return $this->setRoute($this->setUrl(array('zone' => 'front', 'page' => 'user', 'action' => 'login')));
        } elseif($this->app()->httpRequest()->getSession('user')->role !== 'Administrateur') {
            if($this->app()->httpRequest()->getSession('lastUrl') !== null && $this->app()->httpRequest()->getSession('lastZoneName') !== 'admin') {
                return $this->setRoute($this->app()->httpRequest()->getSession('lastUrl'));
            }
            return $this->setRoute($this->setUrl(array('zone' => 'front')));
        }
    }

    public function setUrl($parameters) 
    {
        $zone = $this->app()->getZoneName();
        if(isset($parameters['zone'])) {
            $zone = $parameters['zone'];
            unset($parameters['zone']);
        }
        $url = '/index.php';
        if($zone === 'admin') {
            $url = '/admin/index.php';
        }

        if(count($parameters) > 0) {
            $url .= '?';
            foreach($parameters as $key => $value) {
                if($key !== 'anchor' && $value !== null && $value !== 0) {
                    $url .= $key . '=' . $value . '&';
                }
            }
            $url = preg_replace("#&$#", "", $url);
            if(isset($parameters['anchor'])) {
                $url .= '#' . $parameters['anchor'];
            }
        }

        return $url;
    }

}
