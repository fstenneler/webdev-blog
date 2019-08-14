<?php

namespace app\lib;

class Field
{

    private $fieldName;
    private $minLength;
    private $maxLength;
    private $type;
    private $isMandatory;
    private $placeHolder;
    private $enumValues;
    private $value;
    private $error;

    public function __construct($fieldName, $placeHolder, $minLength, $maxLength, $type, $isMandatory, $enumValues)
    {
        $this->fieldName = $fieldName;
        $this->maxLength = $maxLength;
        $this->minLength = $minLength;
        $this->type = $type;
        $this->isMandatory = $isMandatory;
        $this->placeHolder = $placeHolder;
        $this->enumValues = $enumValues;
        $this->value = null;
        $this->error = null;
    }

    public function setAttributes($placeHolder, $minLength, $maxLength, $type, $isMandatory, $enumValues)
    {
        $this->maxLength = $maxLength;
        $this->minLength = $minLength;
        $this->type = $type;
        $this->isMandatory = $isMandatory;
        $this->placeHolder = $placeHolder;
        $this->enumValues = $enumValues;
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

    public function getEnumValues()
    {
        return $this->enumValues;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getType()
    {
        return $this->type;
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
