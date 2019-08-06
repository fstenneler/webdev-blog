<?php

namespace app;

use app\model\PostModel;

class ControllerApp
{

   public function __construct($app, $pageName) {
      $this->app = $app;
      $this->pageName = $pageName;
   }

   protected function app() {
      return $this->app;
   }

   protected function generatePostUrl($postId) {
      return 'index.php?page=viewpost&postId=' . $postId;
   }

   protected function generateCategoryUrl($categoryId, $currentPage = 1) {
      if( $currentPage > 1) {
         return 'index.php?page=posts&categoryId=' . $categoryId . '&currentPage=' . $currentPage;
      }
      return 'index.php?page=posts&categoryId=' . $categoryId;
   }
 
   protected function generateFrenchDate($date) {
      $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
      $frenchMonths = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
      return str_replace($englishMonths, $frenchMonths, date('j F Y', strtotime($date) ) );        
   }

    
   
}