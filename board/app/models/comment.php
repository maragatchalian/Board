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


     public function countAll($thread_id)
    {
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

        public static function get($id)
            {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM comment WHERE id = ?', array($id));
            if (!$row) {
                throw new RecordNotFoundException('no record found');
        }
            return new self($row);
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
}