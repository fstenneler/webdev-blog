<?php

namespace app\model;
use app\lib\Database;

class CommentModel 
{

    public static function getCommentList($postId = 0, $status = null, $userId = 0)
    {

        $query = '
        SELECT 

        comment.id, 
        comment.parent_comment_id,
        comment.content, 
        comment.date, 
        comment.status, 
        comment.post_id, 
        user.id AS user_id, 
        user.nickname AS user_nickname, 
        user.avatar AS user_avatar, 
        post.title AS post_title

        FROM comment
        LEFT JOIN user ON comment.user_id = user.id
        LEFT JOIN post ON comment.post_id = post.id

        WHERE comment.id>0';

        if($postId > 0 && $postId !== null) {
            $query .= '
        AND comment.post_id = ?';
        }

        if($status !== null && $userId === 0) {
            $query .= '
        AND comment.status = ?';
        } elseif($userId > 0) {
            $query .= '
        AND (
            comment.status = ?
            OR (
                comment.status = \'Attente\'
                AND comment.user_id = ?
            )
        )';
        }

        $query .= '
        ORDER BY parent_comment_id, comment.id ASC';

        $attributes = array();
        if($postId > 0 && $postId !== null) {
            $attributes[] = $postId;
        }
        if($status !== null && $userId === 0) {
            $attributes[] = $status;
        } elseif($userId > 0) {
            $attributes[] = $status;
            $attributes[] = $userId;
        }

        return Database::prepare($query, $attributes);

    }

    public static function getComment($commentId = 0)
    {
        $query = 'SELECT * FROM comment WHERE id = ?';
        $result = Database::prepare($query, array($commentId));
        if(isset($result[0])) { 
            return $result[0];
        }
        return false;
    }


    public static function setComment($attributes)
    {

        if($attributes['id'] > 0) {
            $query = '
        UPDATE';
        } else {
            $query = '
        INSERT INTO';
        }

        $query .= '
        comment
        SET
        parent_comment_id = :parent_comment_id,
        content = :content,
        date = :date,
        status = :status,
        post_id = :post_id,
        user_id = :user_id';

        if($attributes['id'] > 0) {
            $query .= '
        WHERE id = :id';
        } else {
            unset($attributes['id']);
        }

        return Database::prepare($query, $attributes, true);

    }

}
