<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\lib\Form;
use app\model\PostModel;
use app\model\CommentModel;

class ViewpostController extends ControllerApp
{
 
    public function getView()
    {

        //post
        $postList = PostModel::getPost(array('postId' => $this->app()->httpRequest()->getData('postId')));

        //redirection
        if(count($postList) === 0) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        //post infos
        $postList = $this->generatePostListDetails($postList);
        $this->app()->setData('post', $postList[0]);

        //commentForm
        if($this->app()->user()->isAuthenticated()) {
            $form = new Form($this->app());
            $form->setMode('insert');
            $form->setDestination('comment');
            $form->setForm();
            if($form->setValidation()) {
                return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'viewpost', 'postId' => $this->app()->httpRequest()->getData('postId'), 'anchor' => 'comments')));
            }
            $this->app()->setData('form', $form);
        }

        //commentList
        $commentList = CommentModel::getCommentList($this->app()->httpRequest()->getData('postId'), 'Validé', $this->app()->user()->getUserId());
        $this->app()->setData('commentList', $this->generateCommentListDetails($commentList));
        $this->app()->setData('CommentNumberText', $this->generateCommentNumberText($commentList));


        return $this->app()->httpResponse()->generateView();

    }
          
}
