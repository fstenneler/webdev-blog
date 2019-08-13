<?php

namespace app\controller\backend;

use app\ControllerApp;
use app\model\PostModel;
use app\model\UserModel;
use app\model\CategoryModel;

class PostController extends ControllerApp
{
 
    public function getView()
    {

        //postList
        $parameters = array('number' => 0);
        if($this->app()->httpRequest()->getData('postId') > 0) {
            $parameters['postId'] = $this->app()->httpRequest()->getData('postId');
        }

        $postList = PostModel::getPost($parameters);

        //redirection
        if($this->app()->httpRequest()->getData('postId') > 0 && count($postList) === 0) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        //post infos
        $postList = $this->generatePostListDetails($postList);

        if($this->app()->httpRequest()->getData('postId') > 0) {
            $this->app()->setData('postList', $postList[0]);
        } else {
            $this->app()->setData('postList', $postList);
        }

        //categoryList
        $this->app()->setData('categoryList', CategoryModel::getCategoryList());

        //userList
        $this->app()->setData('userList', UserModel::getUserList('Administrateur'));

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
