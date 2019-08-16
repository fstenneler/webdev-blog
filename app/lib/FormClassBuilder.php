<?php

namespace app\lib;
use app\App;
use app\lib\FormBuilder;
use app\lib\FormHandler;
use app\lib\FormManager;

abstract class FormClassBuilder
{
    private $mode;
    private $formId;
    private $destination;
    private $mandatoryFields = array();
    private $defaultValues = array();
    private $dbRowId;
    private $formBuilder;
    private $formHandler;
    private $formManager;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->formBuilder = new FormBuilder($this);
        $this->formHandler = new FormHandler($this);
        $this->formManager = new formManager($this);
        $this->formId = 0;
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

    public function setFormId($formId)
    {
        $this->formId = $formId;
    }

    public function getFormId()
    {
        return $this->formId;
    }

    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setMandatoryFields($mandatoryFields)
    {
        $this->mandatoryFields = $mandatoryFields;

    }

    public function getMandatoryFields()
    {
        return $this->mandatoryFields;
    }

    public function setDefaultValues($defaultValues)
    {
        $this->defaultValues = $defaultValues;

    }

    public function getDefaultValues()
    {
        return $this->defaultValues;
    }

    public function setDbRowId($dbRowId)
    {
        $this->dbRowId = $dbRowId;

    }

    public function getDbRowId()
    {
        return $this->dbRowId;
    }

}
