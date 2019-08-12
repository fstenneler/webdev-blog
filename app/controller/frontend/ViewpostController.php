<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\model\PostModel;
use app\model\CommentModel;

class ViewpostController extends ControllerApp
{
 
    public function getView()
    {

        //post
        $postList = PostModel::getPost(array('postId' => $this->app()->httpRequest()->getData('postId')));

        //redirection
        if($postList === false) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        //post infos
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('post', $postList[0]);

        //commentList
        $commentList = CommentModel::getCommentList($this->app()->httpRequest()->getData('postId'));
        $this->app()->setData('commentList', $this->generateCommentListDetails($commentList));
        $this->app()->setData('CommentNumberText', $this->generateCommentNumberText($commentList));

        return $this->app()->httpResponse()->generateView();

    }
          
}
