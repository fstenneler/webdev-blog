<?php

namespace app\model;
use app\lib\Database;

class CommentModel 
{

    public static function getCommentList($postId = 0, $status = null)
    {

        $db = new Database();

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

        if($status !== null) {
            $query .= '
        AND comment.status = ?';
        }

        $query .= '
        ORDER BY parent_comment_id, comment.id ASC';

        $attributes = array();
        if($postId > 0 && $postId !== null) {
            $attributes[] = $postId;
        }
        if($status !== null) {
            $attributes[] = $status;
        }

        return $db->prepare($query, $attributes);

    }

}
