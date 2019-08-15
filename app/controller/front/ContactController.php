<?php

namespace app\controller\front;

use app\ControllerApp;
use app\lib\Form;

class ContactController extends ControllerApp
{
 
    public function getView()
    {

        //contactForm insert
        $form = new Form($this->app());
        $form->setMode('insert');
        $form->setDestination('contact');
        $form->setMandatoryFields(array('name', 'email', 'subject', 'message', 'privacy_consent_date'));
        $form->setDefaultValues(array('id' => 0, 'date' => date('Y-m-d'), 'message_read' => 0));
        $form->setForm();

        if($form->setValidation()) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'contact')));
        }
        $this->app()->setData('form', $form);

        return $this->app()->httpResponse()->generateView();

    }
          
}
