<?php

namespace app\lib;

use app\model\UserModel;

class User extends ApplicationComponent
{

    public function setAuthentification($email = null, $password = null)
    {

        if($email != null && $password != null) {

            if(UserModel::getPassword($email) === $password) {
                $_SESSION['authenticated'] = true;
                $_SESSION['user'] = UserModel::getUser($email);
                if($this->app()->HTTPRequest()->getSession('lastUrl')) {
                    header('Location: ' . $this->app()->HTTPRequest()->getSession('lastUrl'));
                    exit();
                }
            } else {
                return false;
            }

        }

        return true;
        

    }

    public function setDisconnection() {
        $lastUrl = $this->app()->HTTPRequest()->getSession('lastUrl');
        $_SESSION = array();
        $_SESSION['authenticated'] = false;
        if($lastUrl != null) { echo $lastUrl;
            header('Location: ' . $lastUrl);
            exit();
        }
    }

    public function isAuthenticated() {
        if(!isset($_SESSION['authenticated'])) {
            $_SESSION['authenticated'] = false;
        }
        return $_SESSION['authenticated'];
    }

}