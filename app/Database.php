<?php

namespace app;
use \PDO;

class Database 
{

    private $pdo = null;

    public function getPDO() 
    {

        if($this->pdo == null) {

            $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('SET NAMES utf8');
            $this->pdo = $pdo;
        }

        return $this->pdo;

    }

    public function prepare($query, $attributes) 
    {

        $req = $this->getPDO()->prepare($query);
        $req->execute($attributes);
        $req->setFetchMode(PDO::FETCH_OBJ);
        return $req->fetchAll();

    }

}