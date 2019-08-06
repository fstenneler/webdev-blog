<?php

namespace app\lib;
 
class HTTPResponse extends ApplicationComponent
{
  
    public function generateView($pageName = null) {

        if($pageName == null) {
            $pageName = $this->app()->getPageName();
        }
        
        ob_start();
        require 'app/view/' .  $this->app()->getZoneName() . '/' . strtolower($pageName) . '.php';
        $content = ob_get_clean();
        return $content;

    }

    public function sendHTTP() 
    {
        require 'templates/' . $this->app()->getzoneName() . '.php';
    }

}