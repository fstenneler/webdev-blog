<?php

namespace app;

use app\model\PostModel;

class ControllerApp
{

   public function __construct($app, $pageName)
   {
      $this->app = $app;
      $this->pageName = $pageName;
   }

   protected function app()
   {
      return $this->app;
   }
   
   protected function generateFrenchDate($date)
   {
      $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
      $frenchMonths = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
      return str_replace($englishMonths, $frenchMonths, date('j F Y', strtotime($date) ) );        
   }

   protected function generateAvatarIcon($avatar, $nickName)
   {
      return '<div class="user-avatar-icon" style="background-color: ' . $avatar . ';">' . ucfirst(substr($nickName,0,1)) . '</div>';
   }

   protected function generatePostListDetails($postList)
   {
      foreach($postList as $key => $post) {
         $postList[$key]->avatar_icon = $this->generateAvatarIcon($post->user_avatar, $post->user_nickname);
         $postList[$key]->url = $this->app()->route()->setUrl(array('page' => 'viewpost', 'postId' => $post->post_id));
         $postList[$key]->creation_date = $this->generateFrenchDate($post->creation_date);
         $postList[$key]->last_modification_date = $this->generateFrenchDate($post->last_modification_date);
         $postList[$key]->last_modification_date = $this->generateFrenchDate($post->last_modification_date);
         $postList[$key]->category_url = $this->app()->route()->setUrl(array('page' => 'posts', 'categoryId' => $post->category_id));
      }
      return $postList;
   }

   protected function generatePagination($categoryId = 0, $anchor = null)
   {

      $pagination = array();
      $pagination['dbStart'] = 0;
      $pagination['currentPage'] = 1;
      $pagination['pageList'] = array();
      $pagination['pageNumber'] = ceil( (int) PostModel::getPostNumber($categoryId) / POST_NUMBER );

      if($this->app()->httpRequest()->getData('currentPage') > 0 && $this->app()->httpRequest()->getData('currentPage') <= $pagination['pageNumber']) {
         $pagination['currentPage'] = $this->app()->httpRequest()->getData('currentPage');
         $pagination['dbStart'] = ($this->app()->httpRequest()->getData('currentPage') - 1) * POST_NUMBER;
      }

      $parameters = array('page' => $this->app()->getPageName(), 'categoryId' => $categoryId, 'anchor' => $anchor);
      $pagination['nextPageUrl'] = $this->app()->route()->setUrl($parameters);
      $pagination['previousPageUrl'] = $this->app()->route()->setUrl($parameters);

      for($page = 1; $page <= $pagination['pageNumber']; $page ++) {
         $parameters['currentPage'] = $page;
         $pagination['pageList'][$page] =  $this->app()->route()->setUrl($parameters);
      }

      if($pagination['currentPage'] > 1) {
         $parameters['currentPage'] = $pagination['currentPage'] - 1;
         $pagination['previousPageUrl'] = $this->app()->route()->setUrl($parameters);
      }
      if($pagination['currentPage'] < $pagination['pageNumber'] - 1) {
         $parameters['currentPage'] = $pagination['currentPage'] + 1;
         $pagination['nextPageUrl'] = $this->app()->route()->setUrl($parameters);
      } else {
         $parameters['currentPage'] = $pagination['pageNumber'];
         $pagination['nextPageUrl'] = $this->app()->route()->setUrl($parameters);
      }

      return $pagination;

   }

   protected function generateCommentListDetails($commentList)
   {
      $commentListGroup = array();

      foreach($commentList as $i => $comment) {
          $commentList[$i]->date = $this->generateFrenchDate($comment->date);
          $commentList[$i]->user_avatar_icon = $this->generateAvatarIcon($comment->user_avatar, $comment->user_nickname);
      }

      foreach($commentList as $comment) {
          $commentListGroup[$comment->parent_comment_id][] = $comment;
      }
  
     return $commentListGroup;

   }

   protected function generateCommentNumberText($commentList)
   {
      $CommentNumberText = 'Aucun commentaire déposé pour le moment.';

      if(count($commentList) === 1) {
          $CommentNumberText = '1 commentaire';
      } elseif(count($commentList) > 0) {
         $CommentNumberText = count($commentList). ' commentaires';
      }
  
     return $CommentNumberText;

   }

}
