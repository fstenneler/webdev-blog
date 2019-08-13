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

    public function setErrors()
    {
        foreach($this->field as $fieldName => $field) {
            if($fieldName === 'email' && !preg_match ("/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,6}$/", $field->getValue())) {
                $field->setError('L\'adresse e-mail saisie est erronée');
            }
            if($fieldName === 'email' && UserModel::userExists($field->getValue())) {
                $field->setError('Cette adresse e-mail existe déjà');
            }
            if($fieldName === 'nickname' && UserModel::nicknameExists($field->getValue())) {
                $field->setError('Ce pseudo est déjà utilisé');
            }
            if($fieldName === 'password' && strlen($field->getValue()) < 6) {
                $field->setError('Le nombre de caractères minimum est de ' .$field->getMinLength());
            }
            if($field->isMandatory() && $field->getValue() == '') {
                $field->setError('Le champ est obligatoire');
            }
            if(strlen($field->getValue()) > $field->getMaxLength()) {
                $field->setError('Le nombre de caractères maximum est de ' .$field->getMaxLength());
            }
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

    public function setValues($postData)
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

        if($field->getError() !== null && $this->app->httpRequest()->postData('account_creation') !== null) {
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
        }
        return UserModel::setuser($attributes, $userId);
    }
 
}
