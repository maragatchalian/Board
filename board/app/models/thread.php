<?php

class Thread extends AppModel 
{
    const MIN_TITLE_LENGTH = 1;
    const MAX_TITLE_LENGTH = 30;

    public $validation = array(
    'title' => array(
        'length' => array(
            'validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH
            ),
        ),

    'category' => array(
        'length' => array(
            'validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH
            ),
        ),
    );

    public function create(Comment $comment)
    {
        $this->validate();
        $comment->validate();
        
        if ($this->hasError() || $comment->hasError()) {
            throw new ValidationException('Invalid thread or comment');
        }
            
        try {
            $db = DB::conn();
            $created = date("Y-m-d H:i:s");
            $db->begin();

            $params = array(  
                'title' => $this->title, 
                'created'=> $created, 
                'user_id'=> $this->user_id,
                'category' => $this->category
            );

            $db->insert('thread', $params); 
            $this->id = $db->lastInsertId();
            $comment->write($comment, $this->id); //<--write comment at the same time
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public function checkThreadOwner()
    {
        return $this->user_id === $_SESSION['user_id'];
    }

    public function delete($thread_id)
    {
        Favorite::deleteFavoritedCommentByThreadId($this->id, $this->user_id);
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $this->id,
                $this->user_id
            );
            $db->query("DELETE FROM thread WHERE id = ? AND user_id = ?", $params);
            Comment::deleteByThreadId($this->id, $this->user_id);

            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public static function getAll($offset, $limit, $user_id = NULL)
    {
        $threads = array();
        $db = DB::conn();

        if (!is_int($offset) || !is_int($limit)) { 
            throw new NotIntegerException; 
        }

        if ($user_id == NULL) {
            $rows = $db->rows("SELECT * FROM thread LIMIT {$offset}, {$limit}");

        } else { 
            $rows = $db->rows("SELECT * FROM thread WHERE user_id = ? LIMIT {$offset}, {$limit}", array($user_id));
        }

        foreach($rows as $row) {
            $threads[] = new self($row);
        }
        
        return $threads;
    }

    public static function countAll() 
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM thread");
    }

    public static function countAllThreadByUserId($user_id) 
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM thread WHERE user_id = ?", array($user_id));
    }

    public static function countAllThreadByCategory($category)
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM thread WHERE category = ?", array($category));
    }
      
    public static function get($id) 
    {
        $db = DB::conn();
        $row = $db->row("SELECT * FROM thread WHERE id = ?", array($id));
            
        if (!$row) {
            throw new RecordNotFoundException('No Record Found');
        }
        return new self($row);
    }
    
    public static function getByCategory($offset, $limit, $category) 
    {
        $threads = array();
        $db = DB::conn();

        if (!is_int($offset) || !is_int($limit)) { 
            throw new NotIntegerException; 
        }

        $rows = $db->rows("SELECT * FROM thread WHERE category = ? LIMIT {$offset}, {$limit}", array($category));
            
        foreach($rows as $row) {
            $threads[] = new self($row);
        }
        return $threads;
    }

    public static function getAllCategory()
    {
        $db = DB::conn();
        $rows = $db->rows("SELECT DISTINCT category FROM thread");
        $categories = array();
        
        foreach ($rows as $row) {
            if (!empty($row['category'])) {
                $categories[] = $row['category'];
            }
        }
        return $categories;
    }
} 