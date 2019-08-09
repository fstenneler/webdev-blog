<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\model\PostModel;

class HeaderController extends ControllerApp
{
 
    public function getView()
    {

        //infos user
        if($this->app()->user()->isAuthenticated()) {
            $this->app()->setData('user', $this->app()->httpRequest()->getSession('user'));
            $this->app()->setData('avatarIcon', 
                $this->generateAvatarIcon(
                    $this->app()->httpRequest()->getSession('user')->avatar, 
                    $this->app()->httpRequest()->getSession('user')->nickname
                )
            );
        }

        //Deconnexion
        if($this->app()->httpRequest()->getData('action') === 'logout') {
            $this->app()->user()->setDisconnection();
        }

        //categoryList
        $categoryList = PostModel::getCategoryList();
        foreach($categoryList as $key => $category) {
            $categoryList[$key]->url = $this->app()->route()->setUrl(array('page' => 'posts', 'categoryid' => $category->id));
        }
        $this->app()->setData('categoryList', $categoryList);

        return $this->app()->httpResponse()->generateView('header');

    }
          
}
