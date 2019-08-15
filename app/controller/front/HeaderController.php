<?php

namespace app\controller\front;

use app\ControllerApp;
use app\model\CategoryModel;

class HeaderController extends ControllerApp
{
 
    public function getView()
    {

        //search
        if($this->app()->httpRequest()->getData('s') !== null) {
            return $this->app()->route()->setRoute( $this->app()->route()->setUrl(array('page' => 'posts', 'search' => urlencode($this->app()->httpRequest()->getData('s')))));
        }

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

        //categoryList
        $categoryList = CategoryModel::getCategoryList();
        foreach($categoryList as $key => $category) {
            $categoryList[$key]->url = $this->app()->route()->setUrl(array('page' => 'posts', 'categoryId' => $category->id));
        }
        $this->app()->setData('categoryList', $categoryList);

        return $this->app()->httpResponse()->generateView('header');

    }
          
}
