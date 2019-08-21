<?php

namespace app\model;
use app\lib\Database;

class PostModel 
{

    private static $postId = 0;
    private static $categoryId = 0;
    private static $isHero = 0;
    private static $start = 0;
    private static $number = POST_NUMBER;
    private static $display = 0;
    private static $search = null;
    private static $param = array();

    public static function getParam($key) {
        return isset(self::$param[$key]) ? self::$param[$key] : self::$$key;
    }

    public static function getPost($param = array())
    {
        self::$param = $param;

        $query = '
        SELECT 

        post.id, 
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
        
        if(self::getParam('postId') > 0) {
            $query .= '
        WHERE post.id = :post_id';
        } else {
            $query .= '
        WHERE post.id > 0';
        }

        if(self::getParam('categoryId') > 0) {
            $query .= '
        AND post.category_id = :category_id';
        }

        if(self::getParam('search') !== '') {
            $query .= '
        AND (post.title LIKE :search1 OR post.header LIKE :search2 OR post.content LIKE :search3 OR category.name LIKE :search4)';
        }

        if(self::getParam('isHero') === 1) {
            $query .= '
        AND post.is_hero = 1';
        }

        if(self::getParam('display') === 1) {
            $query .= '
        AND post.display = 1';
        }

        $query .= '
        ORDER BY post.id DESC';

        if(self::getParam('number') > 0 && self::getParam('postId') == 0) {
            $query .= '
        LIMIT :start, :number';
        }

        $attributes = array();
        if(self::getParam('postId') > 0) {
            $attributes['post_id'] = self::getParam('postId');
        }
        if(self::getParam('categoryId') > 0) {
            $attributes['category_id'] = self::getParam('categoryId');
        }
        if(self::getParam('search') !== '') {
            $attributes['search1'] = '%' . self::getParam('search') . '%';
            $attributes['search2'] = '%' . self::getParam('search') . '%';
            $attributes['search3'] = '%' . self::getParam('search') . '%';
            $attributes['search4'] = '%' . self::getParam('search') . '%';
        }
        if(self::getParam('number') > 0 && self::getParam('postId') == 0) {
            $attributes['start'] = self::getParam('start');
            $attributes['number'] = self::getParam('number');
        }

        $result = Database::prepare($query, $attributes, true);

        if(count($result) > 0) {
            return $result;
        }
        return array();

    }

    public static function getFormPost($postId)
    {

        $query = 'SELECT * FROM post WHERE id = ?';
        $result = Database::prepare($query, array($postId));

        if(isset($result[0])) {
            return $result[0];
        }
        return array();

    }

    public static function getPostNumber($categoryId = 0, $search = null)
    {

        $query = '
        SELECT        
        COUNT(post.id) as value        
        FROM post 
        LEFT JOIN category ON category.id = post.category_id
        WHERE post.id>0';

        if( $categoryId > 0 ) {
            $query .= '
        AND category_id = :category_id';
        };
        if($search !== '') {
            $query .= '
        AND (post.title LIKE :search1 OR post.header LIKE :search2 OR post.content LIKE :search3 OR category.name LIKE :search4)';
        }        

        $attributes = array();
        if($categoryId > 0) {
            $attributes['category_id'] = $categoryId;
        }
        if($search !== '') {
            $attributes['search1'] = '%' . $search . '%';
            $attributes['search2'] = '%' . $search . '%';
            $attributes['search3'] = '%' . $search . '%';
            $attributes['search4'] = '%' . $search . '%';
        }

        $result = Database::prepare($query, $attributes, true);
        return $result[0]->value;

    }

    public static function setPost($attributes)
    {

        if($attributes['id'] > 0) {
            $query = '
        UPDATE';
        } else {
            $query = '
        INSERT INTO';
        }

        $query .= '
        post
        SET
        title = :title,
        header = :header,
        content = :content,
        image_main = :image_main,
        image_medium = :image_medium,
        image_small = :image_small,
        creation_date = :creation_date,
        last_modification_date = :last_modification_date,
        is_hero = :is_hero,
        display = :display,
        user_id = :user_id,
        category_id = :category_id';

        if($attributes['id'] > 0) {
            $query .= '
        WHERE id = :id';
        } else {
            unset($attributes['id']);
        }

        return Database::prepare($query, $attributes, true);

    }

}
