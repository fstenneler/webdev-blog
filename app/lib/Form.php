<?php

namespace app\lib;
use app\lib\FormClassBuilder;

/**
* Permet la création d'un formulaire, la récupération, le traitement des erreurs et la sauvegarde des données
*
*/
class Form extends FormClassBuilder
{

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
