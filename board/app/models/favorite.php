<?php

class Favorite extends AppModel 
{

    public static function countFavoriteByCommentId($comment_id)
    {
        $db = DB::conn();
        $total_favorite = $db->value('SELECT COUNT(*) FROM favorite WHERE comment_id =?', array($comment_id));
    
        return $total_favorite;
    }

    public static function isCommentFavorited($comment_id, $user_id)
    {
        $db = DB::conn();
        $comment_favorited = $db->rows('SELECT * FROM favorite WHERE comment_id = ? AND user_id = ?', array($comment_id, $_SESSION['user_id']));
        
        return !$comment_favorited;
    }

    public static function countFavoriteByUserId($user_id)
    {
        $db = DB::conn();
        $fave = $db->value('SELECT COUNT(*) FROM favorite WHERE user_id = ?', array($user_id));
        
        return $fave;
    }

    public static function getAll($offset, $limit, $user_id)
    {
        $favorites = array();
        $db = DB::conn();                  
        $rows = $db->rows("SELECT * FROM favorite WHERE user_id = ? LIMIT {$offset}, {$limit}", array($user_id));
  
        foreach($rows as $row) {
            $favorites[] = new self($row);
        }
        
        return $favorites;
    }

    public static function getDatabyCommentId($comment_id)
    {
        return new self(objectToArray(Comment::get($comment_id)));
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
            $db->query('DELETE FROM favorite WHERE comment_id = ? AND user_id = ?', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function deleteFavoritedComment($id, $user_id)
    {
        try {
            $db = DB::conn();
            $db->begin();
            $db->query('DELETE FROM favorite WHERE comment_id = ? AND user_id = ?', array($id, $user_id));
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }
}