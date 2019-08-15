<?php

namespace app\controller\front;

use app\ControllerApp;
use app\model\PostModel;
use app\model\CategoryModel;

class FooterController extends ControllerApp
{
 
    public function getView()
    {
        //popular posts
        $postList = PostModel::getPost(array('number' => 6));
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('popularPostList', $postList);

        //categoryList
        $categoryList = CategoryModel::getCategoryList();
        foreach($categoryList as $key => $category) {
            $categoryList[$key]->url = $this->app()->route()->setUrl(array('page' => 'posts', 'categoryId' => $category->id));
        }
        $this->app()->setData('categoryList', $categoryList);

        return $this->app()->httpResponse()->generateView('footer');

    }
          
}
