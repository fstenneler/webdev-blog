<?php

namespace app\lib;

/**
* Crée un objet Field représentant un champ de formulaire
*
*/
class Field
{

    private $fieldName;
    private $minLength;
    private $maxLength;
    private $type;
    private $isMandatory;
    private $enumValues;
    private $value;
    private $error;

    public function __construct($fieldName, $minLength, $maxLength, $type, $isMandatory, $enumValues)
    {
        $this->fieldName = $fieldName;
        $this->maxLength = $maxLength;
        $this->minLength = $minLength;
        $this->type = $type;
        $this->isMandatory = $isMandatory;
        $this->enumValues = $enumValues;
        $this->value = null;
        $this->error = null;
    }

    public function setAttributes($minLength, $maxLength, $type, $isMandatory, $enumValues)
    {
        $this->maxLength = $maxLength;
        $this->minLength = $minLength;
        $this->type = $type;
        $this->isMandatory = $isMandatory;
        $this->enumValues = $enumValues;
    }

    public function getName()
    {
        return $this->fieldName;
    }

    public function setMandatory($isMandatory)
    {
        $this->isMandatory = $isMandatory;
    }

    public function isMandatory()
    {
        return $this->isMandatory;
    }

    public function setMaxlength($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function getMaxlength()
    {
        return $this->maxLength;
    }

    public function setMinlength($minLength)
    {
        $this->minLength = $minLength;
    }

    public function getMinlength()
    {
        return $this->minLength;
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
