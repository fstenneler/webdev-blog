<?php

namespace app;

use app\model\PostModel;

/**
* Méthodes communes à tous les controleurs
*
*/  
class ControllerApp
{

	/**
	 * Récupère et stocke l'instanciation de l'application
	 * Récupère et stocke le nom du controleur demandé
	 *
	 * @param object App $app
	 * @param string $pageName
	 */
   public function __construct($app, $pageName)
   {
      $this->app = $app;
      $this->pageName = $pageName;
   }

	/**
	 * Permet d'accéder à l'instancation de l'application
	 *
	 * @return object App
	 */
   protected function app()
   {
      return $this->app;
   }

	/**
	 * Permet de convertir une date au format texte français
	 *
	 * @param string $date Date au format Y/m/d
	 * @return string Date au format jour MoisTxt Année
	 */   
   protected function generateFrenchDate($date)
   {
      $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
      $frenchMonths = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
      return str_replace($englishMonths, $frenchMonths, date('j F Y', strtotime($date) ) );        
   }

	/**
	 * Permet de créer le code html d'un avatar
	 *
	 * @param string $avatar Code couleur de l'avatar
	 * @return string Code html
	 */   
   protected function generateAvatarIcon($avatar, $nickName)
   {
      return '<div class="user-avatar-icon" style="background-color: ' . $avatar . ';">' . ucfirst(substr($nickName,0,1)) . '</div>';
   }

	/**
	 * Permet de convertir les différentes données d'une liste de posts et d'ajouter des détails
	 *
	 * @param array $postList Liste de posts
	 * @return array Liste de posts avec détails
	 */   
   protected function generatePostListDetails($postList)
   {
      foreach($postList as $key => $post) {
         $postList[$key]->avatar_icon = $this->generateAvatarIcon($post->user_avatar, $post->user_nickname);
         $postList[$key]->url = $this->app()->route()->setUrl(array('page' => 'viewpost', 'postId' => $post->id));
         $postList[$key]->creation_date = $this->generateFrenchDate($post->creation_date);
         $postList[$key]->last_modification_date = $this->generateFrenchDate($post->last_modification_date);
         $postList[$key]->category_url = $this->app()->route()->setUrl(array('page' => 'posts', 'categoryId' => $post->category_id));
      }
      return $postList;
   }

	/**
	 * Permet de créer un tableau contenant les différentes informations nécessaires à l'affichage de la pagination
	 *
	 * @param integer $categoryId Identifiant de la catégorie concernée
	 * @param string $search Si recherche, texte recherché
	 * @param string $anchor Si le lien doit envoyer vers une ancre sur la page, nom de l'ancre
	 * @return array $pagination Tableau avec les détails de la pagination
	 */   
   protected function generatePagination($categoryId = 0, $search = null, $anchor = null)
   {

      //valeurs par défaut
      $pagination = array();
      $pagination['dbStart'] = 0;
      $pagination['currentPage'] = 1;
      $pagination['pageList'] = array();

      //calcul du nombre de page total
      $pagination['pageNumber'] = ceil( (int) PostModel::getPostNumber($categoryId, $search) / POST_NUMBER );

      //réglage de la page en cours et de la valeur start de la requete à effectuer pour l'affichage des posts
      if($this->app()->httpRequest()->getData('currentPage') > 0 && $this->app()->httpRequest()->getData('currentPage') <= $pagination['pageNumber']) {
         $pagination['currentPage'] = $this->app()->httpRequest()->getData('currentPage');
         $pagination['dbStart'] = ($this->app()->httpRequest()->getData('currentPage') - 1) * POST_NUMBER;
      }

      //création des urls par défaut des liens page suivante et page précédente
      $parameters = array('page' => $this->app()->getPageName(), 'categoryId' => $categoryId, 'search' => $search, 'anchor' => $anchor);
      $pagination['nextPageUrl'] = $this->app()->route()->setUrl($parameters);
      $pagination['previousPageUrl'] = $this->app()->route()->setUrl($parameters);

      //création des urls de chaque page
      for($page = 1; $page <= $pagination['pageNumber']; $page ++) {
         $parameters['currentPage'] = $page;
         $pagination['pageList'][$page] =  $this->app()->route()->setUrl($parameters);
      }

      //réglage des urls en fonction des butées min et max et de la page en cours
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

	/**
	 * Permet de convertir les différentes données d'une liste de commentaires et d'ajouter des détails
	 *
	 * @param array $postList Liste de commentaires
	 * @return array Liste de commentaires avec détails
	 */   
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

	/**
	 * Permet de créer une valeur textuelle de la phrase à afficher pour le titre des commentaires
	 *
	 * @param array $postList Liste de commentaires
	 * @return string Texte à afficher
	 */   

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
