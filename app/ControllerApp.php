<?php

namespace app;

class ControllerApp
{

   public function __construct($app, $pageName) {
      $this->app = $app;
      $this->pageName = $pageName;
   }

   protected function app() {
      return $this->app;
   }

    
   
}