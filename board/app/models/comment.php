<?php

class Comment extends AppModel 
{

const MIN_BODY_LENGTH = 1;
const MAX_BODY_LENGTH = 140;

    public $validation = array(
        "body" => array(
            "length" => array(
                "validate_between", self::MIN_BODY_LENGTH, self::MAX_BODY_LENGTH,
            ),
        ),
    );

    public static function countAll($thread_id) 
    {
        $db = DB::conn();
        return (int) $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ? ", array($thread_id));
    }

    public static function getAll($offset, $limit, $thread_id) 
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC LIMIT {$offset}, {$limit}", array($thread_id));
        
        foreach ($rows as $row) {
            $comments[] = new self($row);
        }
        
        return $comments;
    }

    public static function newsfeed($thread_id)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment where created <= (CURRENT_TIMESTAMP) ORDER BY created DESC", array($thread_id));
        
        foreach ($rows as $row) {
            $comments[] = new self($row);
        }
        
        return $comments;
    }

    public function write(Comment $comment, $thread_id)
    {
        if(!$this->validate()) {
            throw new ValidationException('invalid comment');
        }

        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'created' => date("Y-m-d H:i:s"),
                'user_id' => $this->user_id,
                'username' => $this->username,
                'thread_id' => $thread_id,
                'body' => $this->body
            );
            $db->insert('comment', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM comment WHERE id = ?', array($id));
            
        if (!$row) {
            throw new RecordNotFoundException('no record found');
        }

        return new self($row);
    }

    public function delete($user_id)
    {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id,
                $this->user_id
            );
            $db->query('DELETE FROM comment WHERE id = ? AND user_id = ?', $params);
            $delete = Favorite::deleteFavoritedComment($this->id, $this->user_id);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function deleteAllComments($thread_id)
    {
        try {
            $db = DB::conn();
            $db->begin();
            $db->query('DELETE FROM comment where thread_id = ?', array($thread_id));
        } catch (Exception $e) {
            $db-rollback();
            }
        }

    /*
    * Functions with regards to favorite/unfavorite comments
    */

    public function countFavorite()
    {
        return Favorite::countFavoriteByCommentId($this->id);
    }

    public function getIsCommentFavorited()
    {
        return Favorite::IsCommentFavorited($this->id, $this->user_id);
    }

    public function isUserComment()
    {
        return $this->user_id === $_SESSION['user_id'];
    }
} //end