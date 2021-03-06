<?php

namespace app\controller\admin;

use app\ControllerApp;
use app\lib\Form;
use app\lib\model\PostModel;
use app\model\CommentModel;

class CommentController extends ControllerApp
{
 
    public function getView()
    {

        //commentList
        $commentList = CommentModel::getCommentList($this->app()->httpRequest()->getData('postId')); 

        //redirection
        if($this->app()->httpRequest()->getData('postId') > 0 && count($commentList) === 0) {
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('page' => 'error')));
        }

        //commentForm
        if($this->app()->httpRequest()->getData('postId') > 0) {
            $form = array();
            foreach($commentList as $comment) {
                if($comment->status === 'Attente') {
                    $form[$comment->id] = new Form($this->app());
                    $form[$comment->id]->setMode('update');
                    $form[$comment->id]->setDestination('comment');
                    $form[$comment->id]->setDefaultValues(
                        array('post_id' => (int) $this->app()->httpRequest()->getData('postId'))
                    );      
                    $form[$comment->id]->setDbRowId($comment->id);
                    $form[$comment->id]->setFormId($comment->id);
                    $form[$comment->id]->setForm();
                    if($form[$comment->id]->setValidation()) {
                        return $this->app()->route()->setRoute(
                            'index.php?page=comment&action=view&postId=' . $this->app()->httpRequest()->getData('postId')
                        );
                    }  
                } 
            }
            $this->app()->setData('form', $form);
        }

        $commentListGroup = $this->generateCommentListDetails($commentList);
        $this->app()->setData('commentList', $commentListGroup);

        $pageName = $this->app()->getPageName() . $this->app()->httpRequest()->getData('action');
        return $this->app()->httpResponse()->generateView($pageName);

    }
          
}
