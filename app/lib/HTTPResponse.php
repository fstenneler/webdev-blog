<?php

namespace app\lib;
 
class HttpResponse extends ApplicationComponent
{
  
    public function generateView($pageName = null) {

        if($pageName === null) {
            $pageName = $this->app()->getPageName();
        }
        
        ob_start();
        $file = 'app/view/' .  $this->app()->getZoneName() . '/' . strtolower($pageName) . '.php';
        if(is_file($file)) {
            require $file;
        }
        $content = ob_get_clean();
        return $content;

    }

    public function sendHttp() 
    {
        require 'templates/' . $this->app()->getzoneName() . '.php';
    }

}
