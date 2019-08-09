<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\model\PostModel;

class FooterController extends ControllerApp
{
 
    public function getView()
    {
        //popular posts
        $postList = PostModel::getPost(array('number' => 6));
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('popularPostList', $postList);

        //categoryList
        $categoryList = PostModel::getCategoryList();
        foreach($categoryList as $key => $category) {
            $categoryList[$key]->url = $this->generatePostsUrl('posts', $category->id, 1, null);
        }
        $this->app()->setData('categoryList', $categoryList);

        return $this->app()->httpResponse()->generateView('footer');

    }
          
}
