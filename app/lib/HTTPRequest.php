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
 
  public function getData($key)
  {
    $get = null;
    if(isset($_GET[$key])) {
      $get = $_GET[$key];
    }
    return $get;
  }
 
  public function getExists($key)
  {
    if(isset($_GET[$key])) {
      return true;
    }
    return false;
  }
 
  public function postData($key)
  {
    $post = null;
    if(isset($_POST[$key])) {
      $post = $_POST[$key];
    }
    return $post;
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
