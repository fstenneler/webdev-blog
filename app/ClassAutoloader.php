<?php

namespace app;

/**
* Charge automatiquement une classe instanciée en utilisant son namespace en tant que chemin vers la classe
*
*/
class ClassAutoloader 
{

	/**
	 * A chaque classe instanciée, si la classe n'a pas été chargée la fonction autoload() sera appelée
	 *
	 */
    public static function register() 
    {
        spl_autoload_register(array(__CLASS__,'autoload'));
        self::autoload();
    }

	/**
     * A chaque appel d'autoload, la méthode va charger le fichier contenant la classe $className
     * Le dossier dans lequel se trouve le fichier correspond exactement au namespace de la classe
     *
     * @param $className Namespace et nom de la classe dont le fichier n'a pas été chargé
	 */    
    private static function autoload($className = null) 
    {
        if($className === null) {
            return false;
        }

        $file = str_replace('\\', '/', $className). '.php';

        if(file_exists($file)) {
            require $file; //on charge la classe
        }

    }

}
