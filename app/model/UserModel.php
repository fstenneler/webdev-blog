<?php

namespace app\model;
use app\lib\Database;

class UserModel 
{

    public static function getPassword($email)
    {
        $db = new Database();
        $query = 'SELECT password FROM user WHERE email = ?';
        $result = $db->prepare($query, array($email));
        if(count($result) > 0) {
            return $result[0]->password;
        } 
        return null;
    }

    public static function userExists($email)
    {
        $db = new Database();
        $query = 'SELECT COUNT(id) AS nb FROM user WHERE email = ?';
        $result = $db->prepare($query, array($email));
        if($result[0]->nb > 0) {
            return true;
        }
        return false;
    }

    public static function nicknameExists($email)
    {
        $db = new Database();
        $query = 'SELECT COUNT(id) AS nb FROM user WHERE LOWER(nickname) = ?';
        $result = $db->prepare($query, array(strtolower($email)));
        if($result[0]->nb > 0) {
            return true;
        }
        return false;
    }

    public static function getUser($email)
    {
        $db = new Database();
        $query = 'SELECT * FROM user WHERE email = ?';
        $result = $db->prepare($query, array($email));
        return $result[0];
    }

    public static function getUserList($role = null, $userId = 0)
    {

        $db = new Database();
        $query = 'SELECT * FROM user WHERE id > 0';

        if($role !== null) {
            $query .= ' AND role = ?';
        }
        if($userId > 0) {
            $query .= ' AND id = ?';
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

    public static function setUser($attributes)
    {

        $db = new Database();

        if($attributes['id'] === 0) {
            $query = '
        INSERT INTO';
        } else {
            $query = '
        UPDATE';
        }

        $query .= '
        user
        SET
        email = :email,
        password = :password,
        name = :name,
        first_name = :first_name,
        nickname = :nickname,
        avatar = :avatar,
        description = :description,
        registration_date = NOW(),
        role = :role';

        if($attributes['id'] > 0) {
            $query .= '
        WHERE id = :id';
        }

        return $db->prepare($query, $attributes, true);

    }


}
