<?php

namespace app\controller\backend;

use app\ControllerApp;
use app\model\UserModel;

class UserController extends ControllerApp
{
 
    public function getView()
    {

        //userList
        $userList = UserModel::getUserList(null, $this->app()->httpRequest()->getData('userId'));
        foreach($userList as $key => $user) {
            $userList[$key]->avatarIcon = $this->generateAvatarIcon($user->avatar, $user->nickname);
        }  

        if($this->app()->httpRequest()->getData('userId') > 0) {
            $this->app()->setData('userList', $userList[0]);
        } else {
            $this->app()->setData('userList', $userList);
        }

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
