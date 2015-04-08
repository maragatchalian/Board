<?php

class Comment extends AppModel {

//Comment Length Validation
const MIN_USERNAME_LENGTH = 1;
const MIN_BODY_LENGTH = 1;

const MAX_USERNAME_LENGTH = 20;
const MAX_BODY_LENGTH = 140;

public $validation = array(
    "username" => array(
        "length" => array(
            "validate_between", self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
            ),
        ),

    "body" => array(
        "length" => array(
            "validate_between", self::MIN_BODY_LENGTH, self::MAX_BODY_LENGTH,
            ),
        ),
    );

    public static function countAll($thread_id) {
        $db = DB::conn();
        return (int) $db->value("SELECT COUNT(*) FROM comment 
            WHERE thread_id = ? ", array($thread_id));
    }

    public static function getAll($offset, $limit, $thread_id) {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment
                WHERE thread_id = ?
                    ORDER BY created ASC LIMIT {$offset}, {$limit}", array($thread_id));
        
        foreach ($rows as $row) {
            $comments[] = new self($row);
        }
        return $comments;
        }

    public function write(Comment $comment, $thread_id) {
    
    if(!$this->validate()) {
        throw new ValidationException('invalid comment');
    }

    try {
        $db = DB::conn();
         $db->begin();
        $params = array(
            'created' => date("Y-m-d H:i:s"),
            'user_id' => $_SESSION['user_id'],
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

    public static function get($id) {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM comment WHERE id = ?', array($id));
            
            if (!$row) {
                throw new RecordNotFoundException('no record found');
            }
    return new self($row);
    }

    public function delete() {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id,
                $_SESSION['user_id']
            );

            $db->query('DELETE FROM comment WHERE id = ? AND user_id = ?', $params);
            $this->deleteFavoritedComment();
            $db->commit();

        } catch (Exception $e) {
            $db->rollback();
        }
    }

    //Functions with regards to favorites
    public function deleteFavoritedComment() {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id,
                $_SESSION['user_id']
        );

        $db->query('DELETE FROM favorite WHERE comment_id = ? AND user_id = ?', $params );
        $db->commit();
        } catch (Exception $e) {
        $db->rollback();
        }
    }

    public function isUserComment() 
    {
        return $this->user_id === $_SESSION['user_id'];       
    }

    public function addFavorite()
    {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'comment_id' => $this->id,
                'comment_body'=> $this->body, //*added
                'user_id' => $_SESSION['user_id']
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
            $this->id, /*if you removed this, once you unvaforited a comment,
                         every comment you favorited will be deleted*/
            $_SESSION['user_id']
            );
    
            $db->query('DELETE FROM favorite WHERE comment_id = ? AND user_id = ?', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public function isCommentFavorited() 
    {
        $db = DB::conn();
        $params = array(
            $this->id,
            $_SESSION['user_id']
        );
        $comment_favorited = $db->rows('SELECT * FROM favorite WHERE comment_id = ? AND user_id = ?', $params);
        return !$comment_favorited;
    }

    public function countFavorite() 
    {
        $db = DB::conn();
        $total_favorite = $db->value('SELECT COUNT(*) FROM favorite WHERE comment_id =?', array($this->id));
    
        return $total_favorite;
    }

    public static function getAllFavorites() 
    {
        $favorites = array();
        $db = DB::conn();
                        
        $rows = $db->rows('SELECT * FROM favorite WHERE user_id = ?', array($_SESSION['user_id']));

            foreach($rows as $row) {
            $favorites[] = new self($row);
            }
        return $favorites;
    }
    
} //end