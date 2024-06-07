<?php

namespace models;

use core\Model;
use core\Core;

/**
 * @property int $id ID коментаря
 * @property int $movie_id ID фільму
 * @property int $user_id ID користувача
 * @property string $content Зміст коментаря
 * @property string $created_at Дата створення коментаря
 */
class Comments extends Model
{
    public static $tableName = 'comments';

    public static function getCommentsByMovieId($movie_id) {
        return self::findByCondition(['movie_id' => $movie_id]);
    }

    public static function addComment($movie_id, $user_id, $content) {
        $comment = new Comments();
        $comment->movie_id = $movie_id;
        $comment->user_id = $user_id;
        $comment->content = $content;
        $comment->created_at = date('Y-m-d H:i:s');
        $comment->save();
    }
}

