<?php

namespace app\model;
use app\lib\Database;

class PostModel 
{

    public static function getParam($param, $key, $default) {
        return isset($param[$key]) ? $param[$key] : $default;
    }


    public static function getPost($param = array())
    {

        $postId = self::getParam($param, 'postId', 0);
        $categoryId = self::getParam($param, 'categoryId', 0);
        $isHero = self::getParam($param, 'isHero', 0);
        $start = self::getParam($param, 'start', 0);
        $number = self::getParam($param, 'number', POST_NUMBER);

        $db = new Database();

        $query = '
        SELECT 

        post.id as post_id, 
        post.title, 
        post.header, 
        post.image_main, 
        post.image_medium, 
        post.image_small, 
        post.creation_date,
        post.content,
        post.last_modification_date,
        post.is_hero,
        post.category_id,
        user.id as user_id,
        user.nickname as user_nickname,
        user.description as user_description,
        user.avatar as user_avatar,
        category.name as category_name,
        (SELECT COUNT(comment.id) FROM comment WHERE comment.post_id = post.id) AS comment_number

        FROM post
        LEFT JOIN user ON post.user_id = user.id
        LEFT JOIN category ON post.category_id = category.id';
        
        if($postId > 0) {
            $query .= '
        WHERE post.id = :post_id';
        } else {
            $query .= '
        WHERE post.id > 0';
        }

        if($categoryId > 0) {
            $query .= '
        AND post.category_id = :category_id';
        }

        if($isHero === 1) {
            $query .= '
        AND post.is_hero = 1';
        }

        $query .= '
        ORDER BY post.id DESC';

        if($number > 0 && $postId == 0) {
            $query .= '
        LIMIT :start, :number';
        }

        $attributes = array();
        if($postId > 0) {
            $attributes['post_id'] = $postId;
        }
        if($categoryId > 0) {
            $attributes['category_id'] = $categoryId;
        }
        if($number > 0 && $postId == 0) {
            $attributes['start'] = $start;
            $attributes['number'] = $number;
        }

        $result = $db->prepare($query, $attributes, true);

        if(count($result) > 0) {
            return $result;
        }
        return array();

    }

    public static function getPostNumber($categoryId = 0)
    {

        $db = new Database();

        $query = 'SELECT COUNT(id) as value FROM post';

        if( $categoryId > 0 ) {
            $query .= ' WHERE category_id = ?';
        };

        $attributes = array();
        if($categoryId > 0) {
            $attributes[] = $categoryId;
        }        

        $result = $db->prepare($query, $attributes);
        return $result[0]->value;

    }

}
