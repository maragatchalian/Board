<?php

class Favorite extends AppModel
{
    public static function countFavoriteByCommentId($comment_id)
    {
        $db = DB::conn();
        $total_favorite = $db->value("SELECT COUNT(*) FROM favorite WHERE comment_id =?", array($comment_id));
    
        return $total_favorite;
    }

    public static function isCommentFavorited($comment_id, $user_id)
    {
        $db = DB::conn();
        $comment_favorited = $db->rows("SELECT * FROM favorite WHERE comment_id = ? AND user_id = ?", array($comment_id, $_SESSION['user_id']));
        
        return !$comment_favorited;
    }

    public static function countFavoriteByUserId($user_id)
    {
        $db = DB::conn();
        $favorite = $db->value("SELECT COUNT(*) FROM favorite WHERE user_id = ?", array($user_id));
        
        return $favorite;
    }

    public static function getAll($offset, $limit, $user_id)
    {
        $favorites = array();
        $db = DB::conn();

        if (!is_int($offset) || !is_int($limit)) {
            throw new NotIntegerException; 
        }

        $rows = $db->rows("SELECT * from favorite WHERE user_id = ? LIMIT {$offset}, {$limit}", array($user_id));
        

        foreach ($rows as $favorite) {
            $favorites[] = new self($favorite);
        }

        foreach ($favorites as $favorite) {
            $row = $db->row("SELECT * from user WHERE username = ? LIMIT {$offset}, {$limit}", array($favorite->username));
            $favorite->user_id = $row['id'];
        }
        return $favorites;
    }

    public static function getDataByCommentId($comment_id)
    {
        return new self(object_to_array(Comment::get($comment_id)));
    }

    public function addFavorite()
    {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'username' => $this->username,
                'comment_id' => $this->id,
                'comment_body'=> $this->body,
                'thread_id' => $this->thread_id,
                'user_id' => $this->user_id
            );
            $db->insert('favorite', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public function removeFavorite()
    {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                /*if you removed this, once you unvaforited a comment,
                every comment you favorited will be deleted*/
                $this->id, 
                $this->user_id,
            );
            $db->query("DELETE FROM favorite WHERE comment_id = ? AND user_id = ?", $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function deleteFavoritedComment($comment_id, $user_id)
    {
        try {
            $db = DB::conn();
            $db->begin();
            $db->query("DELETE FROM favorite WHERE comment_id = ? AND user_id = ?", array($comment_id, $user_id));
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function deleteFavoritedCommentByThreadId($thread_id, $user_id)
    {
        try {
            $db = DB::conn();
            $db->begin();
            $db->query("DELETE FROM favorite WHERE thread_id = ? AND user_id = ?", array($thread_id, $user_id));
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }
}