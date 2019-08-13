<?php

namespace app\lib;
use \PDO;

class Database 
{

    private $pdo = null;

    public function getPDO() 
    {

        if($this->pdo === null) {

            $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('SET NAMES utf8');
            $this->pdo = $pdo;
        }

        return $this->pdo;

    }

    public function prepare($query, $attributes, $bindValue = false) 
    {

        $req = $this->getPDO()->prepare($query);

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

        if(preg_match("#^SELECT#", trim($query))) {
            $req->setFetchMode(PDO::FETCH_OBJ);
            return $req->fetchAll();
        } else {
            return $result;
        }

        return false;

    }

}
