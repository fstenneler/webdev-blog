<?php

namespace app\lib;
use app\lib\FormComponent;
use app\lib\Field;

class FormBuilder Extends FormComponent
{
    private $field = array();
  
    public function createField($fieldName, $placeHolder, $minLength, $maxLength, $type, $isMandatory)
    {
        $this->field[$fieldName] = new Field($fieldName, $placeHolder, $minLength, $maxLength, $type, $isMandatory);
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
            
            if($this->form()->getMode() === 'update') {
                $this->createField('id', null, 0, 100, 'int', true);
            }
            $this->createField('email', 'Votre adresse e-mail', 0, 100, 'string', true);
            $this->createField('password', 'Votre mot de passe', 6, 20, 'string', true);
            $this->createField('name', 'Votre nom', 0, 50, 'string', true);
            $this->createField('first_name', 'Votre prénom', 0, 50, 'string', true);
            $this->createField('nickname', 'Votre pseudo', 0, 50, 'string', true);
            $this->createField('avatar', null, 0, 7, 'string', true);
            $this->createField('description', 'Votre description', 0, 500, 'string', false);
            $this->createField('registration_date', null, 0, 10, 'string', true);
            $this->createField('role', null, 0, 14, 'string', false);

        } elseif($this->form()->getDestination() === 'comment') {

            if($this->form()->getMode() === 'update') {
                $this->createField('id', null, 0, 100, 'int', true);
            }
            $this->createField('parent_comment_id', null, 0, 11, 'int', true);
            $this->createField('content', 'Votre message', 0, 500, 'string', true);
            $this->createField('date', null, 0, 10, 'string', true);
            $this->createField('status', null, 0, 10, 'string', false);

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
