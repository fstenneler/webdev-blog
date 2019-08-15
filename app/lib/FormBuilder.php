<?php

namespace app\lib;
use app\lib\FormComponent;
use app\lib\Field;

class FormBuilder Extends FormComponent
{
    private $field = array();
  
    public function createField($fieldName, $minLength, $maxLength, $type, $isMandatory, $enumValues = array())
    {
        if(!isset($this->field[$fieldName])) {
            $this->field[$fieldName] = new Field($fieldName, $minLength, $maxLength, $type, $isMandatory, $enumValues);
        } else {
            $this->field[$fieldName]->setAttributes($minLength, $maxLength, $type, $isMandatory, $enumValues);
        }
    }

    public function getFields()
    {
        return $this->field;
    }

    public function getField($fieldName)
    {
        return $this->field[$fieldName];
    }

    public function setFieldValue($fieldName, $value)
    {
        $this->field[$fieldName]->setValue($value);
    }

    public function setFieldMandatory($fieldName, $value)
    {
        $this->field[$fieldName]->setMandatory($value);
    }

    public function setFieldLength($fieldName, $minLength, $maxLength)
    {
        $this->field[$fieldName]->setMinLength($minLength);
        $this->field[$fieldName]->setMaxLength($maxLength);
    }

    public function setFields()
    {

        //chargement de toutes les colonnes de la table et création des champs correspondants
        foreach($this->formManager()->loadDbFields($this->form()->getDestination()) as $dbField) {
            $this->createField($dbField->Field, $dbField->MinSize, $dbField->MaxSize, $dbField->Type, false, $dbField->Enum);
        }
        
        //si update, chargement des valeurs des champs de la ligne correspondante dans la base, et attribution
        if($this->form()->getMode() === 'update') {
            $this->formBuilder()->setFieldValues($this->formManager()->loadData());
        }

        //réglage des champs obligatoires du formulaire
        foreach($this->form()->getMandatoryFields() as $fieldName) {
            $this->setFieldMandatory($fieldName, true); 
        }
        
    }

    public function setFieldValues($data)
    {
        foreach($this->getFields() as $fieldName => $field) {
            if(isset($data[$fieldName])) {
                $this->setFieldValue($fieldName, $data[$fieldName]);
            }
        }
    }

    public function setDefaultValues()
    {        
        foreach($this->form()->getDefaultValues() as $fieldName => $defaultValue) {
            $this->setFieldValue($fieldName, $defaultValue);
        }
    }


}
