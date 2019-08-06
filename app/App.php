<?php

namespace app;
use app\lib\User;
use app\lib\HTTPRequest;
use app\lib\HTTPResponse;
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
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->route = new Route($this);
    }

    public function User() {
        return $this->user;
    }

    public function HTTPRequest() {
        return $this->httpRequest;
    }

    public function HTTPResponse() {
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


        if($this->zoneName == 'backend') {
            $this->route()->setBackendAccess();
        }
                
        $this->setContent('mainContent', $this->getController($this->pageName)->getView());
        if($this->zoneName != 'backend') {
            $this->setContent('header', $this->getController('Header')->getView());
            $this->setContent('footer', $this->getController('Footer')->getView());
        }
        $this->HTTPResponse()->sendHTTP();

    }

}