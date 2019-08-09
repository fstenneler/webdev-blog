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

   protected function generatePostUrl($postId)
   {
      return 'index.php?page=viewpost&postId=' . $postId;
   }

   protected function generatePostsUrl($pageName = 'posts', $categoryId = 0, $currentPage = 1, $anchor = null)
   {
      $url = 'index.php?page=' . $pageName;
      if( $categoryId > 0) {
         $url .= '&categoryId=' . $categoryId;
      }
      if( $currentPage > 1) {
         $url .= '&currentPage=' . $currentPage;
      }
      if( $anchor != null) {
         $url .= '#' . $anchor;
      }
      return $url;
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
         $postList[$key]->url = $this->generatePostUrl($post->post_id);
         $postList[$key]->creation_date = $this->generateFrenchDate($post->creation_date);
         $postList[$key]->last_modification_date = $this->generateFrenchDate($post->last_modification_date);
         $postList[$key]->last_modification_date = $this->generateFrenchDate($post->last_modification_date);
         $postList[$key]->category_url = $this->generatePostsUrl('posts', $post->category_id, 1);
      }
      return $postList;
   }

   protected function generatePagination($categoryId = 0, $anchor = null)
   {

      $pagination = array();
      $pagination['dbStart'] = 0;
      $pagination['currentPage'] = 1;
      $pagination['pageList'] = array();
      $pagination['nextPageUrl'] = $this->generatePostsUrl($this->app()->getPageName(), $categoryId, 1, $anchor);
      $pagination['previousPageUrl'] = $this->generatePostsUrl($this->app()->getPageName(), $categoryId, 1, $anchor);
      $pagination['pageNumber'] = ceil( (int) PostModel::getPostNumber($categoryId) / POST_NUMBER );

      if($this->app()->httpRequest()->getData('currentPage') > 0 && $this->app()->httpRequest()->getData('currentPage') <= $pagination['pageNumber']) {
         $pagination['currentPage'] = $this->app()->httpRequest()->getData('currentPage');
         $pagination['dbStart'] = ($this->app()->httpRequest()->getData('currentPage') - 1) * POST_NUMBER;
      }

      for($page = 1; $page <= $pagination['pageNumber']; $page ++) {
         $pagination['pageList'][$page] =  $this->generatePostsUrl($this->app()->getPageName(), $categoryId, $page, $anchor);
      }

      if($pagination['currentPage'] > 1) {
         $pagination['previousPageUrl'] = $this->generatePostsUrl($this->app()->getPageName(), $categoryId, $pagination['currentPage'] - 1, $anchor);
      }
      if($pagination['currentPage'] < $pagination['pageNumber'] - 1) {
         $pagination['nextPageUrl'] = $this->generatePostsUrl($this->app()->getPageName(), $categoryId, $pagination['currentPage'] + 1, $anchor);
      } else {
         $pagination['nextPageUrl'] = $this->generatePostsUrl($this->app()->getPageName(), $categoryId, $pagination['pageNumber'], $anchor);
      }

      return $pagination;

   }

   
}
