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

    public static function getUserList($role = null, $userId = 0)
    {

        $db = new Database();

        $query = '
        SELECT 

        *

        FROM

        user
        WHERE id > 0';

        if($role !== null) {
            $query .= '
        AND role = ?';
        }

        if($userId > 0) {
            $query .= '
        AND id = ?';
        }

        $attributes = array();
        if($role !== null) {
            $attributes[] = $role;
        }
        if($userId > 0) {
            $attributes[] = $userId;
        }

        return $db->prepare($query, $attributes);

    }


}
