<?php

namespace app;
use app\lib\User;
use app\lib\HttpRequest;
use app\lib\HttpResponse;
use app\lib\Route;

class App
{

    public $zoneName;
    public $pageName;
    private $user;
    private $httpRequest;
    private $httpResponse;
    private $route;
    private $data;
    private $content;

    public function __construct($zoneName, $pageName) {
        $this->zoneName = $zoneName;
        $this->pageName = $pageName;
        $this->user = new User($this);
        $this->httpRequest = new HttpRequest($this);
        $this->httpResponse = new HttpResponse($this);
        $this->route = new Route($this);
    }

    public function user() {
        return $this->user;
    }

    public function httpRequest() {
        return $this->httpRequest;
    }

    public function httpResponse() {
        return $this->httpResponse;
    }

    public function route() {
        return $this->route;
    }
  
    public function getZoneName()
    {
        return $this->zoneName;
    }
  
    public function getPageName()
    {
        return $this->pageName;
    }
  
    public function setData($index, $value)
    {
        $this->data[$index] = $value;
    }

    public function getData($index)
    {
        if(isset($this->data[$index])) {
            return $this->data[$index];
        }
        return null;
    }
  
    public function setContent($index, $value)
    {
        $this->content[$index] = $value;
    }

    public function getContent($index)
    {
        return $this->content[$index];
    }

    private function getController($pageName) {
        $className = 'app\controller\\' . $this->zoneName . '\\' . $pageName . 'Controller';
        return new $className($this, $pageName);
    }

    public function run() {

        //enregistrement de la dernière page visitée
        $this->route()->setLastRoute();


        if($this->zoneName === 'backend') {
            $this->route()->setBackendAccess();
        }

        $view = array($this->pageName);
        if($this->zoneName === 'backend') {
            $view[] = 'topbar';
            $view[] = 'navbar';
        } elseif($this->zoneName === 'frontend') {
            $view[] = 'header';
            $view[] = 'footer';
        }

        foreach($view as $pageName) {
            $getView = $this->getController($pageName)->getView();
            if($getView) {
                $this->setContent($pageName,  $getView);
            } else {
                return false;
            }
        }
        
        $this->httpResponse()->sendHttp();

    }

}
