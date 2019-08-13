<?php

namespace app\lib;
 
class HttpRequest extends ApplicationComponent
{
  public function cookieData($key)
  {
    $cookie = null;
    if(isset($_COOKIE[$key])) {
      $cookie = $_COOKIE[$key];
    }
    return $cookie;
  }
 
  public function cookieExists($key)
  {
    if(isset($_COOKIE[$key])) {
      return true;
    }
    return false;
  }
 
  public function getData($key = null)
  {
    if($key !== null) {
      if(isset($_GET[$key])) {
        return $_GET[$key];
      }
      return null;
    }
    return $_GET;
  }
 
  public function getExists($key = null)
  {
    if(isset($_GET[$key])) {
      return true;
    }
    return false;
  }
 
  public function postData($key = null)
  {
    if($key !== null) {
      if(isset($_POST[$key])) {
        return $_POST[$key];
      }
      return null;
    }
    return $_POST;
  }
 
  public function postExists($key)
  {
    if(isset($_POST[$key])) {
      return true;
    }
    return false;
  }
  
  public function getSession($key)
  {
    $session = null;
    if(isset($_SESSION[$key])) {
      $session = $_SESSION[$key];
    }
    return $session;
  }
  
  public function sessionExists($key)
  {
    if(isset($_SESSION[$key])) {
      return true;
    }
    return false;
  }
  
  public function setSession($key, $value)
  {
    if($key === null) {
      $_SESSION = $value;
      return;
    }
    $_SESSION[$key] = $value;
  }

  public function requestURI()
  {
    $requestUri = $_SERVER['REQUEST_URI'];
    return $requestUri;
  }
}
