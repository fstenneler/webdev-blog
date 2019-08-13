<?php

namespace app\lib;
use app\controller\frontend\UserController;
use app\lib\Field;
use app\model\UserModel;

class Form
{
    private $field = array();
    private $mode;

    public function __construct(UserController $user)
    {
        $this->app = $user->app;
    }
    
    public function setField($fieldName, $placeHolder, $minLength, $maxLength, $isMandatory)
    {
        $this->field[$fieldName] = new Field($fieldName, $placeHolder, $minLength, $maxLength, $isMandatory);
    }

    public function getField($fieldName)
    {
        return $this->field[$fieldName];
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function setFields()
    {
        $this->setField('first_name', 'Votre prénom', 0, 50, true);
        $this->setField('name', 'Votre nom', 0, 50, true);
        $this->setField('email', 'Votre adresse e-mail', 0, 100, true);
        $this->setField('nickname', 'Votre pseudo', 0, 50, true);
        $this->setField('password', 'Votre mot de passe', 6, 20, true);
        $this->setField('avatar', null, 0, 7, true);
    }

    public function getEmailFieldError($field)
    {
        if(!preg_match ("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,6}$/", $field->getValue())) {
            return 'L\'adresse e-mail saisie est erronée';
        }
        if($this->mode === 'insert') {
            if(UserModel::userExists($field->getValue())) {
                return 'Cette adresse e-mail existe déjà';
            }
        } elseif($field->getValue() !== $this->app->httpRequest()->getSession('user')->email) {
            if(UserModel::userExists($field->getValue())) {
                return 'Cette adresse e-mail existe déjà';
            }
        }
        return $field->getError();
    }

    public function getNicknameFieldError($field)
    {
        if($this->mode === 'insert') {
            if(UserModel::nicknameExists($field->getValue())) {
                return 'Ce pseudo est déjà utilisé par un autre utilisateur';
            }
        } elseif($field->getValue() !== $this->app->httpRequest()->getSession('user')->nickname) {
            if(UserModel::nicknameExists($field->getValue())) {
                return 'Ce pseudo est déjà utilisé par un autre utilisateur';
            }
        }
        return $field->getError();
    }

    public function getGenericFieldError($field)
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
        foreach($this->field as $fieldName => $field) {
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
        foreach($this->field as $field) {
            if($field->getError() !== null) {
                return false;
            }
        }
        return true;
    }

    public function setFieldValues($postData)
    {
        foreach($this->field as $fieldName => $field) {
            if(isset($postData[$fieldName])) {
                $this->field[$fieldName]->setValue($postData[$fieldName]);
            }
        }
    }

    public function generateFormField(Field $field)
    {
        $required = null;
        $type = 'text';

        if($field->isMandatory()) {
            $required = ' required';
        }
        if($field->getName() === 'email') {
           $type = 'email';
        }
        if($field->getName() === 'password') {
            $type = 'password';
        }

        $html = '<div><input name="' . htmlspecialchars($field->getName()) . '" id="c' . htmlspecialchars(ucfirst($field->getName())) . '" class="full-width" placeholder="' . htmlspecialchars($field->getPlaceHolder()) . '*" value="' . htmlspecialchars($field->getValue()) . '" type="' . $type . '" minlength="' . htmlspecialchars($field->getMinlength()) . '" maxlength="' . htmlspecialchars($field->getMaxlength()) . '"'. $required . '></div>';

        if($field->getError() !== null && $this->isSubmited()) {
            $html .= '<div class="error">' . $field->getError() . '</div>';
        }

        return $html;
    }

    public function save()
    {
        $attributes = array();
        foreach($this->field as $fieldName => $field) {
            $attributes[$fieldName] = $field->getValue();
        }
        if($this->mode === 'insert') {
            $attributes['description'] = null;
            $attributes['role'] = 'Visiteur';
            $userId = 0;
        } else {
            $attributes['description'] = $this->app->httpRequest()->getSession('user')->description;
            $attributes['role'] = $this->app->httpRequest()->getSession('user')->role;
            $userId = $this->app->httpRequest()->getSession('user')->id;
        }
        return UserModel::setUser($attributes, $userId);
    }

    public function setForm()
    {
        $this->setFields();

        //chargement de la bdd
        if($this->mode === 'update') {
            $this->getAccountData();
        }

        //hydratation et test des erreurs
        $this->setFieldValues($this->app->httpRequest()->postData());
        $this->setErrors();
    }

    public function setFormSubmit()
    {       
        //enregistrement et redirection
        if($this->isSubmited()) {
            if($this->isValid()) {
                if($this->save()) {
                    $this->app->httpRequest()->setSession('updateSuccess', true);
                    $user = UserModel::getUser($this->getField('email')->getValue());
                    return $this->app->user()->setAuthentification($user->email, $user->password);
                }
            }
        }
        return false;
    }

    public function getAccountData()
    {
        $sessionData = array();
        foreach($this->field as $fieldName => $field) {
            $sessionData[$fieldName] = $this->app->httpRequest()->getSession('user')->$fieldName;
        }
        $this->setFieldValues($sessionData);
    }

    public function isSubmited()
    {
        if($this->app->httpRequest()->postData('submit') !== null) {
            return true;
        }
        return false;
    }
 
}
