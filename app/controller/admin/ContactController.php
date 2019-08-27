<?php

namespace app\controller\admin;

use app\ControllerApp;
use app\lib\Form;
use app\model\ContactModel;

class ContactController extends ControllerApp
{
 
    public function getView()
    {

        //Liste des messages
        $contactList = ContactModel::getContactList($this->app()->httpRequest()->getData('contactId'), 0);

        //redirection
        if($this->app()->httpRequest()->getData('contactId') > 0 && count($contactList) === 0) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        if($this->app()->httpRequest()->getData('contactId') > 0) {
            $this->app()->setData('contactList', $contactList[0]);
        } else {
            $this->app()->setData('contactList', $contactList);
        }

        //message read Form
        if($this->app()->httpRequest()->getData('contactId') > 0) {
            $form = array();
            $form = new Form($this->app());
            $form->setMode('update');
            $form->setDestination('contact');
            $form->setDefaultValues(array('message_read' => 1));        
            $form->setDbRowId($this->app()->httpRequest()->getData('contactId'));
            $form->setForm();
            if($form->setValidation()) {
                return $this->app()->route()->setRoute(
                    'index.php?page=contact&action=view&contactId=' . $this->app()->httpRequest()->getData('contactId')
                );
            }  
            $this->app()->setData('form', $form);
        }

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
