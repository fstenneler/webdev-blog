<?php

namespace app\model;
use app\lib\Database;

class PostModel 
{

    public static function getParam($param, $key, $default) {
        return isset($param[$key]) ? $param[$key] : $default;
    }


    public static function getPost($param)
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
        post.category_id,
        user.nickname as user_nickname,
        user.description as user_description,
        user.avatar as user_avatar,
        category.name as category_name

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
        return false;

    }

    public static function getPostNumber($categoryId = 0)
    {

        $db = new Database();

        $query = '
        SELECT 

        COUNT(id) as value

        FROM post';

        if( $categoryId > 0 ) {
            $query .= '
        WHERE category_id = ?';
        };

        $result = $db->prepare( $query, array($categoryId) );
        return $result[0]->value;

    }

    public static function getCategoryList($categoryId = 0)
    {

        $db = new Database();

        $query = '
        SELECT 

        *

        FROM category';

        if( $categoryId > 0 ) {
            $query .= '
        WHERE id = ?';
        }

        $query .= '
        ORDER BY name ASC';

        return $db->prepare($query, array($categoryId));

    }

    public static function getCategoryName($categoryId = 0)
    {

        $db = new Database();

        $query = '
        SELECT 

        name

        FROM category

        WHERE id = ?';

        $result = $db->prepare($query, array($categoryId));

        if(isset($result[0]->name)) {
            return $result[0]->name;
        }
        return null;

    }

    public static function categoryExists($categoryId = 0)
    {

        $db = new Database();

        $query = '
        SELECT 

        COUNT(id) AS value

        FROM category

        WHERE id = ?';

        $result = $db->prepare($query, array($categoryId));

        if($result[0]->value > 0) {
            return $result[0]->value;
        }
        return false;

    }

    public static function getCategoryByName($categoryName)
    {

        $db = new Database();

        $query = '
        SELECT 

        id

        FROM category

        WHERE id = ?';

        $result = $db->prepare($query, array($categoryName));

        if($result[0]->value > 0) {
            return $result[0]->value;
        }
        return 0;

    }

    public static function getCommentList($postId)
    {

        $db = new Database();

        $query = '
        SELECT 

        comment.id, 
        comment.parent_comment_id,
        comment.content, 
        comment.date AS comment_date, 
        user.nickname AS user_nickname, 
        user.avatar AS user_avatar

        FROM comment
        LEFT JOIN user ON comment.user_id = user.id
        WHERE comment.post_id = ?
        ORDER BY parent_comment_id, comment.id ASC';

        return $db->prepare( $query, array($postId) );

    }

}
