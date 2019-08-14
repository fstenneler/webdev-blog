<?php

namespace app\lib;
use app\lib\FormComponent;
use app\model\UserModel;

class FormHandler Extends FormComponent
{

    public function getEmailFieldError(Field $field)
    {
        if(!preg_match ("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,6}$/", $field->getValue())) {
            return 'L\'adresse e-mail saisie est erronée';
        }
        if($this->form()->getMode() === 'insert') {
            if(UserModel::userExists($field->getValue())) {
                return 'Cette adresse e-mail existe déjà';
            }
        } elseif($field->getValue() !== $this->app()->httpRequest()->getSession('user')->email) {
            if(UserModel::userExists($field->getValue())) {
                return 'Cette adresse e-mail existe déjà';
            }
        }
        return $field->getError();
    }

    public function getNicknameFieldError(Field $field)
    {
        if($this->form()->getMode() === 'insert') {
            if(UserModel::nicknameExists($field->getValue())) {
                return 'Ce pseudo est déjà utilisé par un autre utilisateur';
            }
        } elseif($field->getValue() !== $this->app()->httpRequest()->getSession('user')->nickname) {
            if(UserModel::nicknameExists($field->getValue())) {
                return 'Ce pseudo est déjà utilisé par un autre utilisateur';
            }
        }
        return $field->getError();
    }

    public function getGenericFieldError(Field $field)
    {
        if($field->getMinLength() > 0 && strlen($field->getValue()) < $field->getMinLength()) {
            return 'Le nombre minimum de caractères est de ' .$field->getMinLength();
        }
        if(strlen($field->getValue()) > $field->getMaxLength()) {
            return 'Le nombre maximum de caractères est de ' .$field->getMaxLength();
        }
        if($field->isMandatory() && $field->getValue() == '') {
            return 'Le champ est obligatoire';
        }
        return $field->getError();
    }

    public function setErrors()
    {
        foreach($this->formBuilder()->getFields() as $fieldName => $field) {
            if($fieldName === 'email') {
                $field->setError($this->getEmailFieldError($field));
            }
            if($fieldName === 'nickname') {
                $field->setError($this->getNicknameFieldError($field));
            }
            $field->setError($this->getGenericFieldError($field));
        }
    }

    public function isValid()
    {
        foreach($this->formBuilder()->getFields() as $field) {
            if($field->getError() !== null) {
                return false;
            }
        }
        return true;
    }


}
