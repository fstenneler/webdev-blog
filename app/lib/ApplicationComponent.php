<?php

namespace app\lib;
 
abstract class ApplicationComponent
{
  protected $app;
 
  public function __construct($app)
  {
    $this->app = $app;
  }
 
  public function app()
  {
    return $this->app;
  }
}