<?php

namespace app\lib;

use app\model\UserModel;

class User extends ApplicationComponent
{

    public function setAuthentification($email = null, $password = null)
    {

        if($email !== null && $password !== null) {

            if(UserModel::getPassword($email) === $password) {
                $this->app()->httpRequest()->setSession('authenticated', true);
                $this->app()->httpRequest()->setSession('user', UserModel::getUserByEmail($email));
                if($this->app()->httpRequest()->getSession('lastUrl')) {
                    return $this->app()->route()->setRoute($this->app()->httpRequest()->getSession('lastUrl'));
                } else{
                    return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'account')));
                }
            } else {
                return false;
            }

        }

        return true;
        

    }

    public function setDisconnection() {
        $lastUrl = $this->app()->httpRequest()->getSession('lastUrl');
        $this->app()->httpRequest()->setSession(null, array());
        $this->app()->httpRequest()->setSession('authenticated', false);
       return  $this->app()->route()->setRoute($lastUrl);
    }

    public function isAuthenticated() {
        if($this->app()->httpRequest()->sessionExists('authenticated') === false) {
            $this->app()->httpRequest()->setSession('authenticated', false);
        }
        return  $this->app()->httpRequest()->getSession('authenticated');
    }

    public function getUserId()
    {
        $userId = 0;
        if(isset($this->app()->httpRequest()->getSession('user')->id)) {
            $userId = $this->app()->httpRequest()->getSession('user')->id;
        }
        return $userId;
    }

}
