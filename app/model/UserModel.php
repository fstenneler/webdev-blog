<?php

namespace app\model;
use app\lib\Database;

class UserModel 
{

    public static function getPassword($email)
    {

        $db = new Database();

        $query = '
        SELECT 

        password

        FROM

        user

        WHERE email = ?';

        $result = $db->prepare( $query, array($email) );

        return $result[0]->password;

    }

    public static function getUser($email)
    {

        $db = new Database();

        $query = '
        SELECT 

        *

        FROM

        user

        WHERE email = ?';

        $result = $db->prepare( $query, array($email) );

        return $result[0];

    }


}
