<?php

namespace app\lib;
use app\lib\FormComponent;
use app\lib\Field;

class FormBuilder Extends FormComponent
{
    private $field = array();
  
    public function createField($fieldName, $placeHolder, $minLength, $maxLength, $type, $isMandatory, $enumValues = array())
    {
        if(!isset($this->field[$fieldName])) {
            $this->field[$fieldName] = new Field($fieldName, $placeHolder, $minLength, $maxLength, $type, $isMandatory, $enumValues);
        } else {
            $this->field[$fieldName]->setAttributes($placeHolder, $minLength, $maxLength, $type, $isMandatory, $enumValues);
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

    public function setFields()
    {
        
        //si update, création et chargement des valeurs de tous les champs de la base
        if($this->form()->getMode() === 'update') {
            $data = $this->formManager()->loadData();
            foreach($data as $fieldName => $fieldValue) {
                $this->createField($fieldName, null, 0, 0, gettype($fieldValue), false);
            }
            $this->formBuilder()->setFieldValues($data);
        }

        //champs
        if($this->form()->getDestination() === 'user') {        

            $this->createField('id', null, 0, 100, 'integer', false);
            $this->createField('email', 'Votre adresse e-mail', 0, 100, 'string', true);
            $this->createField('password', 'Votre mot de passe', 6, 20, 'string', true);
            $this->createField('name', 'Votre nom', 0, 50, 'string', true);
            $this->createField('first_name', 'Votre prénom', 0, 50, 'string', true);
            $this->createField('nickname', 'Votre pseudo', 0, 50, 'string', true);
            $this->createField('avatar', null, 0, 7, 'string', true);
            $this->createField('description', 'Votre description', 0, 500, 'string', false);
            $this->createField('registration_date', null, 0, 10, 'string', false);
            $this->createField('role', null, 0, 14, 'string', false);

        } elseif($this->form()->getDestination() === 'comment') {

            $this->createField('id', null, 0, 11, 'integer', false);
            $this->createField('parent_comment_id', null, 0, 11, 'integer', false);
            $this->createField('content', 'Votre message', 0, 500, 'string', true);
            $this->createField('status', null, 0, 10, 'string', false, array('Attente', 'Validé', 'Refusé'));
            $this->createField('date', null, 0, 10, 'string', false);
            $this->createField('user_id', null, 0, 11, 'integer', false);
            $this->createField('post_id', null, 0, 11, 'integer', false);

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
  
        if($this->form()->getDestination() === 'user') {

            if($this->form()->getMode() === 'insert') {
                $this->setFieldValue('id', 0);
                $this->setFieldValue('description', null);
                $this->setFieldValue('registration_date', date('Y-m-d'));
                $this->setFieldValue('role', 'Visiteur');
            }

        } elseif($this->form()->getDestination() === 'comment') {

            if($this->form()->getMode() === 'insert') {
                $this->setFieldValue('id', 0);
                $this->setFieldValue('status', 'Attente');
                $this->setFieldValue('date', date('Y-m-d'));
                $this->setFieldValue('user_id', (int) $this->app()->httpRequest()->getSession('user')->id);
            }
            $this->setFieldValue('post_id', (int) $this->app()->httpRequest()->getData('postId'));
            
        }

    }


}
