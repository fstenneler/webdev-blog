<?php

namespace app\controller\frontend;

use app\ControllerApp;
use app\model\PostModel;

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
        $commentList = PostModel::getCommentList($this->app()->httpRequest()->getData('postId'));
        if(count($commentList) > 0) {
            $CommentNumberText = count($commentList). ' commentaires';
        } elseif(count($commentList) == 1) {
            $CommentNumberText = '1 commentaire';
        } else {
            $CommentNumberText = 'Aucun commentaire dÃ©posÃ© pour le moment.';
        }
        foreach($commentList as $i => $comment) {
            $commentList[$i]->comment_date = $this->generateFrenchDate($comment->comment_date);
            $commentList[$i]->user_avatar_icon = $this->generateAvatarIcon($comment->user_avatar, $comment->user_nickname);
        }

        $commentListGroup = array();
        foreach($commentList as $comment) {
            $commentListGroup[$comment->parent_comment_id][] = $comment;
        }
    
        $this->app()->setData('CommentNumberText', $CommentNumberText);
        $this->app()->setData('commentList', $commentListGroup);

        //var_dump( $commentListGroup); die();

        return $this->app()->httpResponse()->generateView();

    }
          
}
