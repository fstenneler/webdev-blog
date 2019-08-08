<?php

/**
* Class ClassAutoloader
* Charge automatiquement une classe instanciée en utilisant son namespace en tant que chemin vers la classe
*/

namespace app;

class ClassAutoloader 
{

    public static function register() 
    {
        spl_autoload_register(array(__CLASS__,'autoload'));
        self::autoload();
    }
    
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
