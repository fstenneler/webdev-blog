<?php

namespace app\controller\backend;

use app\ControllerApp;
use app\lib\model\PostModel;
use app\model\CommentModel;

class CommentController extends ControllerApp
{
 
    public function getView()
    {

        //commentList
        $commentList = CommentModel::getCommentList($this->app()->httpRequest()->getData('postId')); 
        $commentListGroup = $this->generateCommentListDetails($commentList);
        $this->app()->setData('commentList', $commentListGroup);

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
