<?php

namespace app;
use app\lib\User;
use app\lib\HttpRequest;
use app\lib\HttpResponse;
use app\lib\Route;
      
/**
* Méthodes de l'application
*
*/  
class App
{

    private $zoneName;
    private $pageName;
    private $user;
    private $httpRequest;
    private $httpResponse;
    private $route;
    private $data;
    private $content;

	/**
	 * Instanciation des classes de la librairie
	 * récupération de la zone et de la page à afficher
	 *
	 * @param string $zoneName
	 * @param string $pageName
	 */
    public function __construct($zoneName, $pageName) {
        $this->zoneName = $zoneName;
        $this->pageName = $pageName;
        $this->user = new User($this);
        $this->httpRequest = new HttpRequest($this);
        $this->httpResponse = new HttpResponse($this);
        $this->route = new Route($this);
    }

	/**
	 * Méthode pour faire appel à l'instanciation de la classe User
	 *
	 * @return object User
	 */
    public function user() {
        return $this->user;
    }

	/**
	 * Méthode pour faire appel à l'instanciation de la classe httpRequest
	 *
	 * @return object HttpRequest
	 */
    public function httpRequest() {
        return $this->httpRequest;
    }

	/**
	 * Méthode pour faire appel à l'instanciation de la classe httpResponse
	 *
	 * @return object HttpResponse
	 */
    public function httpResponse() {
        return $this->httpResponse;
    }

	/**
	 * Méthode pour faire appel à l'instanciation de la classe route
	 *
	 * @return object Route
	 */
    public function route() {
        return $this->route;
    }
  
	/**
	 * Retourne la variable zoneName correspondant à zone de la page à afficher
	 *
	 * @return string $zoneName
	 */
    public function getZoneName()
    {
        return $this->zoneName;
    }
    
	/**
	 * Retourne la variable pageName correspondant à la page à afficher
	 *
	 * @return string $pageName
	 */
    public function getPageName()
    {
        return $this->pageName;
    }
      
	/**
     * Ajoute dans un tableau $data un nouvel index $index avec une $valeur $value
     * Ce tableau permet de stocker les éléments à afficher dans les vues
	 *
	 * @param string $index
	 * @param mixed $value
	 */
    public function setData($index, $value)
    {
        $this->data[$index] = $value;
    }
      
	/**
     * Permet de récupérer la valeur de l'index $index stocké dans le tableau $data
     * Ce tableau permet de stocker les éléments à afficher dans les vues
     * Si l'index n'existe pas, retourne null
	 *
	 * @param string $index
	 * @return mixed
	 */
    public function getData($index)
    {
        if(isset($this->data[$index])) {
            return $this->data[$index];
        }
        return null;
    }
      
	/**
     * Permet de stocker dans un tableau $content les différents contenus à afficher sur la page.
     * Les contenus sont stockés dans le tableau par nom de la vue générée par le controleur concerné
	 *
	 * @param string $index
	 * @param mixed $value
	 */  
    public function setContent($index, $value)
    {
        $this->content[$index] = $value;
    }
      
	/**
     * Permet de récupérer le contenu stocké dans le tableau $content de la vue générée par le controleur $index
	 *
	 * @param string $index
	 * @return string
	 */  

     public function getContent($index)
     {
         return $this->content[$index];
     }
       
	/**
     * Permet d'instancier le controleur à afficher, et de retourner son instanciation
     * Le controleur est situé dans un namespace composé du nom de la zone et du nom du controleur à afficher (peut être différent de la page à afficher)
	 *
	 * @param string $pageName
	 * @return object
	 */
    private function getController($pageName) {
        $className = 'app\controller\\' . $this->zoneName . '\\' . ucfirst($pageName) . 'Controller';
        return new $className($this, $pageName);
    }
      
	/**
     * Permet de lancer l'application
     * En fonction de la zone, les différents controleurs sont instanciés et les vues générées sont stockées dans le tableau $content
     * La méthode envoie enfin les contenus dans le template correspondant à la zone
	 *
	 */
    public function run() {

        //enregistrement de la dernière page visitée
        $this->route()->setLastRoute();

        //si zone admin, on vérifie que l'utilisateur est connecté, sinon on l'envoie vers la page de connexion
        if($this->zoneName === 'admin') {
            $this->route()->setBackendAccess();
        }

        //on crée la liste des controleurs à instancier en fonction de la zone et de la page à afficher
        $view = array($this->pageName);
        if($this->zoneName === 'admin') {
            $view[] = 'topbar';
            $view[] = 'navbar';
        } elseif($this->zoneName === 'front') {
            $view[] = 'header';
            $view[] = 'footer';
        }

        //pour chaque controleur, on l'instancie et on stocke dans le tableau $content le résultat de la vue à afficher
        foreach($view as $pageName) {
            $getView = $this->getController($pageName)->getView();
            if($getView) {
                $this->setContent($pageName,  $getView);
            } else {
                return false;
            }
        }  

        //on inclut le template concerné, qui va afficher les vues du tableau $content
        $this->httpResponse()->sendHttp();

    }

}
