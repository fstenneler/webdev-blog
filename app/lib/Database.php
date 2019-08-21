<?php

namespace app\lib;
use \PDO;

/**
* Crée une connexion à la base de données et effectue les requetes
*
*/
class Database 
{

    private static $pdo = null;

	/**
	 * Crée une instanciation de PDO et renvoie l'objet créé. Si il est déjà crée, renvoie l'objet déjà créé
	 *
	 * @return object PDO
	 */
    public static function getPDO() 
    {

        if(self::$pdo === null) {

            $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE); //force int à renvoyer int
            $pdo->exec('SET NAMES utf8');
            self::$pdo = $pdo;
        }

        return self::$pdo;

    }

	/**
     * Exécute une requete avec PDO après avoir créé une connexion
     * Si $bindValue est à true, il s'agit d'une requete comprenant des attributs $attributes à binder
     * Si la requete est de type SELECT ou SHOW, elle renvoie les résultats, sinon un booléen selon le succès ou l'échec de la requete
	 *
	 * @return mixed
	 */
    public static function prepare($query, $attributes, $bindValue = false) 
    {

        $req = self::getPDO()->prepare($query);

        if($bindValue) {
            foreach($attributes as $key => $value) {
                if(is_int($value)) {
                    $req->bindValue(':' .$key, $value, PDO::PARAM_INT);
                } else {
                    $req->bindValue(':' .$key, $value);
                }
            }
            $result = $req->execute();
        } else {
            $result = $req->execute($attributes);
        }

        if(preg_match("#^SELECT#", trim($query)) || preg_match("#^SHOW#", trim($query))) {
            $req->setFetchMode(PDO::FETCH_OBJ);
            return $req->fetchAll();
        } else {
            return $result;
        }

        return false;

    }

}
