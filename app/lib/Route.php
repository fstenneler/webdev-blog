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
            return $this->setRoute($this->setUrl(array('zone' => 'frontend', 'page' => 'login')));
        } elseif($this->app()->httpRequest()->getSession('user')->role !== 'Administrateur') {
            if($this->app()->httpRequest()->getSession('lastUrl') !== null && $this->app()->httpRequest()->getSession('lastZoneName') !== 'backend') {
                return $this->setRoute($this->app()->httpRequest()->getSession('lastUrl'));
            }
            return $this->setRoute($this->setUrl(array('zone' => 'frontend')));
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
        if($zone === 'backend') {
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
