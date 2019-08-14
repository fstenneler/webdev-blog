<?php

namespace app\lib;
use app\lib\FormClassBuilder;

class Form extends FormClassBuilder
{

    public function generateHtmlField(Field $field)
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

    public function setForm()
    {
        $this->formBuilder()->setFields();
        if($this->isSubmited()) {
            $this->formBuilder()->setFieldValues($this->app()->httpRequest()->postData());
            $this->formBuilder()->setDefaultValues();
            $this->formHandler()->setErrors();
        }

    }

    public function setValidation()
    {       
        if($this->isSubmited()) {
            if($this->formHandler()->isValid()) {
                if($this->formManager()->save()) {
                    $this->setSuccess(true);
                    return true;
                }
            }
        }
        return false;
    }

    public function isSubmited()
    {
        if(
            ($this->app()->httpRequest()->postData('submit') !== null && $this->getFormId() === 0)
            || ($this->app()->httpRequest()->postData('submit') !== null && $this->getFormId() === (int) $this->app()->httpRequest()->postData('id'))
        ) {
            return true;
        }
        return false;
    }

    public function setSuccess($success)
    {
        $this->app()->httpRequest()->setSession('formUpdate', array('destination' => $this->getDestination(), 'success' => $success));
    }

    public function getSuccess()
    {
        $formUpdate = $this->app()->httpRequest()->getSession('formUpdate');
        if(isset($formUpdate['destination']) && isset($formUpdate['success'])) { 
            if($formUpdate['destination'] === $this->getDestination()) {
                return $formUpdate['success'];
            }
        }
    }
 
}
