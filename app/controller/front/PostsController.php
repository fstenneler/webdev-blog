<?php

namespace app\controller\front;

use app\ControllerApp;
use app\controller\front\ErrorController;
use app\model\PostModel;
use app\model\CategoryModel;

class PostsController extends ControllerApp
{
 
    public function getView()
    {

        //Test existance catégorie
        if($this->app()->httpRequest()->getData('categoryId') > 0) {
            if(CategoryModel::categoryExists($this->app()->httpRequest()->getData('categoryId')) === false) {
                return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
            }
        }

        //categoryName
        $this->app()->setData(
            'categoryName',
            CategoryModel::getCategoryName($this->app()->httpRequest()->getData('categoryId'))
        );

        //postList
        $pagination = $this->generatePagination(
            $this->app()->httpRequest()->getData('categoryId'),
            $this->app()->httpRequest()->getData('search')
        );
        $postList = PostModel::getPost(
            array(
                'start' => $pagination['dbStart'],
                'categoryId' => $this->app()->httpRequest()->getData('categoryId'),
                'search' => $this->app()->httpRequest()->getData('search'),
                'display' => 1
            )
        );
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('pagination', $pagination);
        $this->app()->setData('postList', $postList);

        return $this->app()->httpResponse()->generateView();

    }
          
}
