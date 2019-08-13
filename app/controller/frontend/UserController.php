<?php

namespace app\controller\frontend;

use app\model\UserModel;
use app\ControllerApp;
use app\lib\Form;

class UserController extends ControllerApp
{
 
    public function getView()
    {
    
        switch($this->app()->httpRequest()->getData('action')) {

            //login
            case 'login':

                if($this->app()->user()->setAuthentification($this->app()->httpRequest()->postData('cEmail'), $this->app()->httpRequest()->postData('cPassword')) === false) {
                    $this->app()->setData('email', $this->app()->httpRequest()->postData('cEmail'));
                    $this->app()->setData('formError', 'L\'adresse e-mail ou le mot de passe saisis sont erronés.');
                } 
                break;
            
            //logout
            case 'logout':

                //Deconnexion
                return $this->app()->user()->setDisconnection();
                break;
            
            //signup
            case 'signup':

                $form = new Form($this);
                $form->setMode('insert');
                $form->setForm();
                $form->setFormSubmit();
                $this->app()->setData('form', $form);
                break;
            
            //signup
            case 'account':

                if($this->app()->user()->isAuthenticated() === false) {
                    return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'user', 'action' => 'login')));
                }
                $form = new Form($this);
                $form->setMode('update');
                $form->setForm();
                if($form->setFormSubmit()) {
                    $this->app()->setData('success', true);
                }
                $this->app()->setData('form', $form);
                break;

        }


        $pageName = $this->app()->getPageName() . '_' . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
