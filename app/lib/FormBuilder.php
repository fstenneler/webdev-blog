<?php

namespace app\lib;
use app\lib\FormComponent;
use app\lib\Field;

class FormBuilder Extends FormComponent
{
    private $field = array();
  
    public function createField($fieldName, $placeHolder, $minLength, $maxLength, $isMandatory)
    {
        $this->field[$fieldName] = new Field($fieldName, $placeHolder, $minLength, $maxLength, $isMandatory);
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

    public function setFields()
    {
        if($this->form()->getDestination() === 'user') {

            $this->createField('first_name', 'Votre prénom', 0, 50, true);
            $this->createField('name', 'Votre nom', 0, 50, true);
            $this->createField('email', 'Votre adresse e-mail', 0, 100, true);
            $this->createField('nickname', 'Votre pseudo', 0, 50, true);
            $this->createField('password', 'Votre mot de passe', 6, 20, true);
            $this->createField('avatar', null, 0, 7, true);

        } elseif($this->form()->getDestination() === 'comment') {

            $this->createField('parent_comment_id', null, 0, 11, true);
            $this->createField('content', 'Votre message', 0, 500, true);

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


}