<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\controller\frontend\ErrorController;
use app\model\PostModel;

class PostsController extends ControllerApp
{
 
    public function getView()
    {

        //Test existance catégorie
        if(PostModel::categoryExists($this->app()->httpRequest()->getData('categoryId')) === false) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        //categoryName
        $this->app()->setData('categoryName', PostModel::getCategoryName($this->app()->httpRequest()->getData('categoryId')));

        //postList
        $pagination = $this->generatePagination($this->app()->httpRequest()->getData('categoryId'));
        $postList = PostModel::getPost(array('start' => $pagination['dbStart'], 'categoryId' => $this->app()->httpRequest()->getData('categoryId')));
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('pagination', $pagination);
        $this->app()->setData('postList', $postList);

        return $this->app()->httpResponse()->generateView();

    }
          
}
