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
            
            //signup
            case 'signup':

                //creation du form
                $form = new Form($this);
                $form->setMode('insert');
                $form->setField('first_name', 'Votre prénom', 0, 50, true);
                $form->setField('name', 'Votre nom', 0, 50, true);
                $form->setField('email', 'Votre adresse e-mail', 0, 100, true);
                $form->setField('nickname', 'Votre pseudo', 0, 50, true);
                $form->setField('password', 'Votre mot de passe', 6, 20, true);
                $form->setField('avatar', null, 0, 7, true);
                $this->app()->setData('form', $form);
        
                //hydratation et test des erreurs
                $this->app()->getData('form')->setValues($this->app()->httpRequest()->postData());
                $this->app()->getData('form')->setErrors();
        
                //enregistrement et redirection
                if($this->app()->getData('form')->isValid()) {
                    if($this->app()->getData('form')->save()) {
                        $user = UserModel::getUser($this->app()->getData('form')->getField('email')->getValue());
                        return $this->app()->user()->setAuthentification($user->email, $user->password);
                    }
                }
                break;
            
            //logout
            case 'logout':

                //Deconnexion
                return $this->app()->user()->setDisconnection();
                break;

        }


        $pageName = $this->app()->getPageName() . '_' . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
