<?php

namespace app\controller\front;

use app\ControllerApp;
use app\model\PostModel;

class HomeController extends ControllerApp
{
 
    public function getView()
    {

        //hero
        $postList = PostModel::getPost(array('number' => 0, 'isHero' => 1, 'display' => 1));
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('heroPostList', $postList);

        //postList
        $pagination = $this->generatePagination(0, null, 'posts');
        $postList = PostModel::getPost(array('start' => $pagination['dbStart'], 'display' => 1));
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('pagination', $pagination);
        $this->app()->setData('postList', $postList);


        return $this->app()->httpResponse()->generateView();

    }
          
}
