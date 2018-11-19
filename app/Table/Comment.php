<?php
/**
 * Created by PhpStorm.
 * User: PC-PRO
 * Date: 19/11/2018
 * Time: 11:56
 */

namespace App\Table;
use App\App;

class Comment extends Table
{
    protected static $table = 'comment';


    public static function getComments($postId, $validate = false) {
        if ($validate) {
            $query = 'SELECT * FROM ' . static::$table .' WHERE post_id = ? AND validate = true';
        } else {
            $query = 'SELECT * FROM ' . static::$table .' WHERE post_id = ?';
        }
        return App::getDatabase()->prepare($query, get_called_class(), [$postId]);
    }
    public static function add($postId, $userId, $content, $validate = false) {
        $query = '
            INSERT INTO ' . static::$table .'
            (post_id, user_id, content, validate)
            VALUES(?, ?, ?, ?);
        ';
        return App::getDatabase()->prepareUpdate($query, array($postId, $userId, $content, intval($validate)));
    }
}