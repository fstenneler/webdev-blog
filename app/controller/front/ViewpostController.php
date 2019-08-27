<?php

namespace app\controller\front;

use app\ControllerApp;
use app\lib\Form;
use app\model\PostModel;
use app\model\CommentModel;

class ViewpostController extends ControllerApp
{
 
    public function getView()
    {

        //post
        $postList = PostModel::getPost(
            array(
                'postId' => $this->app()->httpRequest()->getData('postId'),
                'display' => 1
            )
        );

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
            $form->setMandatoryFields(array('content'));
            $form->setDefaultValues(array(
                'id' => 0, 
                'status' => 'Attente', 
                'date' => date('Y-m-d'), 
                'user_id' => (int) $this->app()->user()->getUserId(), 
                'post_id' => (int) $this->app()->httpRequest()->getData('postId')
            ));
            $form->setForm();
            if($form->setValidation()) {
                return $this->app()->route()->setRoute(
                    $this->app()->route()->setUrl(
                        array(
                            'page' => 'viewpost',
                            'postId' => $this->app()->httpRequest()->getData('postId'),
                            'anchor' => 'comments'
                        )
                    )
                );
            }
            $this->app()->setData('form', $form);
        }

        //commentList
        $commentList = CommentModel::getCommentList(
            $this->app()->httpRequest()->getData('postId'),
            'Validé',
            $this->app()->user()->getUserId(),
            0
        );
        $this->app()->setData('commentList', $this->generateCommentListDetails($commentList));
        $this->app()->setData('CommentNumberText', $this->generateCommentNumberText($commentList));


        return $this->app()->httpResponse()->generateView();

    }
          
}
