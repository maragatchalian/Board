<?php

//Comment Validation
class Comment extends AppModel {

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
    
    if(!$comment->validate()) {
        throw new ValidationException('invalid comment');
    }

    try {
        $db = DB::conn();
        $created = date("Y-m-d H:i:s");
        $db->begin();
        $params = array(
            
            'thread_id' => $thread_id,
            'body' => $comment->body,
            'created' => $created
        );

        $db->insert('comment', $params);
        $db->commit();
        } catch (Exception $e) {
        $db->rollback();
        }
    }

    //Delete own comment
    public function delete($id) {
        try {
        $db = DB::conn();
        $db->begin();
        $delete = $db->query('DELETE FROM comment WHERE id = ?', array($this->id));
        $db->commit();
        } catch (Exception $e) {
        $db->rollback();
        }
    }

    public function addFavorite() {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'comment_id' => $this->id,
                'user_id' => $_SESSION['user_id']
            );
        
        $db->insert('favorite', $params);
        $db->commit();
        } catch (Exception $e) {
        $db->rollback();
        }
    }
    public function removeFavorite() {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id,
                $_SESSION['user_id']
            );

        $db->query('DELETE FROM favorite WHERE comment_id = ? AND user_id = ?', $params);
        $db->commit();
        } catch (Exception $e) {
        $db->rollback();
        }
    }

       //select the favoited comments
    public function is_favorited() {
        $db = DB::conn();
            $params = array(
            $this->id,      
            $_SESSION['user_id']
            );
        $comment_favorited = $db->row('SELECT * FROM  favorite
            WHERE comment_id = ? AND user_id = ?', $params);
        return !$comment_favorited;
        }

    //count the favotites in each comment
    public function countFavorite() {
        $db = DB::conn();
        $total_favorites = $db->value('SELECT COUNT(*) FROM favorite
            WHERE comment_id =?', array($this->id));
        
        return $total_favorites;
    }

     public function getThreadId() {
            $db = DB::conn();
            $thread_id = $db->row('SELECT thread_id FROM comment
            WHERE id = ?', array($this->comment_id));
        return implode($thread_id);
    }   




}