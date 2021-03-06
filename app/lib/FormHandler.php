<?php

namespace app\lib;
use app\lib\FormComponent;
use app\model\UserModel;

/**
* Gestion des erreurs du formulaire
*
*/
class FormHandler Extends FormComponent
{

    public function getEmailFieldError(Field $field)
    {
        if(
            !preg_match(
                "/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,6}$/",
                $field->getValue()
            )
        ) {
            return 'L\'adresse e-mail saisie est erronée';
        }
        if($this->form()->getMode() === 'insert') {
            if(UserModel::userExists($field->getValue())) {
                return 'Cette adresse e-mail existe déjà';
            }
        } elseif($field->getValue() !== UserModel::getEmail($this->form()->getDbRowId())) {
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
        } elseif($field->getValue() !== UserModel::getNickname($this->form()->getDbRowId())) {
            if(UserModel::nicknameExists($field->getValue())) {
                return 'Ce pseudo est déjà utilisé par un autre utilisateur';
            }
        }
        return $field->getError();
    }

    public function getEnumFieldError(Field $field, $enumValues)
    {   
        foreach($enumValues as $value) {
            if($field->getValue() === $value) {
                return $field->getError();
            }
        }
        return 'La valeur du champ est incorrecte';
    }

    public function getFileFieldError(Field $field)
    {   
        if(isset($_FILES[$field->getName()])) {
            if(!preg_match('#image#', $_FILES[$field->getName()]['type'])) {
                return 'Le type du fichier chargé n\'est pas pris en charge';
            }
            if(!preg_match('#image#', $_FILES[$field->getName()]['type'])) {
                return 'Le fichier chargé dépasse la taille maximum autorisée';
            }
            return $field->getError();    
        }
        return null;
    }

    public function getGenericFieldError(Field $field)
    {
        if($field->getMinLength() > 0 && strlen($field->getValue()) < $field->getMinLength()) {
            return 'Le nombre minimum de caractères est de ' .$field->getMinLength();
        }
        if(strlen($field->getValue()) > $field->getMaxLength() && $field->getMaxLength() > 0) {
            return 'Le nombre maximum de caractères est de ' .$field->getMaxLength();
        }
        if($field->isMandatory() && trim(strip_tags($field->getValue())) == '') {
            return 'Le champ est obligatoire';
        }
        return $field->getError();
    }

    public function setErrors()
    {
        foreach($this->formBuilder()->getFields() as $fieldName => $field) {
            if($fieldName === 'email' && $this->form()->getDestination() === 'user') {
                $field->setError($this->getEmailFieldError($field));
            }
            if($fieldName === 'nickname' && $this->form()->getDestination() === 'user') {
                $field->setError($this->getNicknameFieldError($field));
            }
            if(count($field->getEnumValues()) > 0) {
                $field->setError($this->getEnumFieldError($field, $field->getEnumValues()));
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
