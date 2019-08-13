<?php

namespace app\lib;

class Field
{

    private $fieldName;
    private $minLength;
    private $maxLength;
    private $isMandatory;
    private $placeHolder;
    private $value;
    private $error;

    public function __construct($fieldName, $placeHolder, $minLength, $maxLength, $isMandatory)
    {
        $this->fieldName = $fieldName;
        $this->maxLength = $maxLength;
        $this->minLength = $minLength;
        $this->isMandatory = $isMandatory;
        $this->placeHolder = $placeHolder;
        $this->value = null;
        $this->error = null;
    }

    public function getName()
    {
        return $this->fieldName;
    }

    public function isMandatory()
    {
        return $this->isMandatory;
    }

    public function getMaxlength()
    {
        return $this->maxLength;
    }

    public function getMinlength()
    {
        return $this->minLength;
    }

    public function getPlaceHolder()
    {
        return $this->placeHolder;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }

}
