<?php

namespace app\lib;
use app\App;
use app\lib\FormBuilder;
use app\lib\FormHandler;
use app\lib\formManager;

abstract class FormClassBuilder
{
    private $mode;
    private $destination;
    private $formBuilder;
    private $formHandler;
    private $formManager;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->formBuilder = new FormBuilder($this);
        $this->formHandler = new FormHandler($this);
        $this->formManager = new formManager($this);
   }

    public function app()
    {
        return $this->app;
    }

    public function formBuilder()
    {
        return $this->formBuilder;
    }

    public function formHandler()
    {
        return $this->formHandler;
    }

    public function formManager()
    {
        return $this->formManager;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function getDestination()
    {
        return $this->destination;
    }

}
