<?php

namespace app\controller\front;

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

                if($this->app()->user()->setAuthentification(
                    $this->app()->httpRequest()->postData('cEmail'),
                    $this->app()->httpRequest()->postData('cPassword')) === false
                ) {
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

                $form = new Form($this->app());
                $form->setMode('insert');
                $form->setDestination('user');
                $form->setMandatoryFields(
                    array(
                        'email',
                        'password',
                        'name',
                        'first_name',
                        'nickname',
                        'avatar'
                    )
                );
                $form->setDefaultValues(
                    array (
                        'id'=> 0,
                        'description' => null,
                        'registration_date' => date('Y-m-d'),
                        'role' => 'Visiteur'
                    )
                );
                $form->setForm();
                if($form->setValidation()) {
                    $user = UserModel::getUserByEmail($form->formBuilder()->getField('email')->getValue());
                    return $this->app()->user()->setAuthentification($user->email, $user->password);
                }
                $this->app()->setData('form', $form);
                break;
            
            //account
            case 'account':

                if($this->app()->user()->isAuthenticated() === false) {
                    return $this->app()->route()->setRoute(
                        $this->app()->route()->setUrl(
                            array(
                                'page' => 'user',
                                'action' => 'login'
                            )
                        )
                    );
                }
                $form = new Form($this->app());
                $form->setMode('update');
                $form->setDestination('user');
                $form->setMandatoryFields(array('email', 'password', 'name', 'first_name', 'nickname', 'avatar'));
                $form->setDbRowId($this->app()->user()->getUserId());
                $form->setForm();
                if($form->setValidation()) {
                    $user = UserModel::getUserByEmail($form->formBuilder()->getField('email')->getValue());
                    return $this->app()->user()->setAuthentification($user->email, $user->password);
                }
                $this->app()->setData('form', $form);
                break;

        }


        $pageName = $this->app()->getPageName() . '_' . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
