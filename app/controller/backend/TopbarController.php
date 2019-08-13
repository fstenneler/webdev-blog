<?php

namespace app\controller\backend;

use app\ControllerApp;
use app\model\CommentModel;
use app\model\ContactModel;

class TopbarController extends ControllerApp
{
 
    public function getView()
    {
        
        //Deconnexion
        if($this->app()->httpRequest()->getData('logout') === 'true') {
            $this->app()->user()->setDisconnection();
            return $this->app()->route()->setRoute($this->app()->route()->setUrl(array('zone' => 'frontend', 'page' => 'user', 'action' => 'login')));
        }
        
        //Avatar
        $this->app()->setData('avatarIcon', $this->generateAvatarIcon($this->app()->httpRequest()->getSession('user')->avatar, $this->app()->httpRequest()->getSession('user')->nickname));

        //commentList
        $commentList = CommentModel::getCommentList($this->app()->httpRequest()->getData('postId'), 'Attente'); 
        $commentListGroup = $this->generateCommentListDetails($commentList);
        $this->app()->setData('commentList', $commentListGroup);
        $this->app()->setData('CommentNumber', count($commentList));
        $this->app()->setData('CommentNumberText', $this->generateCommentNumberText($commentList));

        //Liste des messages
        $this->app()->setData('contactList', ContactModel::getContactList($this->app()->httpRequest()->getData('contactId'), 0));

        return $this->app()->httpResponse()->generateView('topbar');

    }
          
}
