<?php

class Thread extends AppModel{

/* 
*The following constants are declared to avoid magic numbers.
*Avoid using magic numbers so others couuld
*   understand what that number is all about.
*/
    const MIN_TITLE_LENGTH = 1;
    const MAX_TITLE_LENGTH = 30;

//Thread Length Validation
    public $validation = array(
        'title' => array(
            'length' => array(
                'validate_between', self::MIN_TITLE_LENGTH, self::MAX_TITLE_LENGTH
            ),
        ),
    );

        public function create(Comment $comment) { 
        
        $this->validate();
        $comment->validate();

            if ($this->hasError() || $comment->hasError())
            {
                throw new ValidationException('Invalid thread or comment');
            }

        $date_created = date("Y-m-d H:i:s");
        $params = array(
            'title' => $this->title,
            'created'=> $date_created
             );

    //Latest inserted ID
            try 
            {
                $db = DB::conn();
                $db->begin();
                $db->insert('thread', $params);
                $this->id = $db->lastInsertId();

    //write first comment at the same time
                $this->write($comment);
                $db->commit();
            } catch (Exception $e) {
                $db->rollback();
            }
    }

    public static function getAll($offset, $limit) 
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread LIMIT {$offset}, {$limit}");

        foreach($rows as $row) 
        {
            $threads[] = new self($row);
        }

    return $threads;
    }

    public static function countAll()
    {
        $db = DB::conn();
        return (int) $db->value('SELECT COUNT(*) FROM thread');
    }

    public function countComments()
    {
        $db = DB::conn();
        return (int) $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ? ", array($this->id));
    }


    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));
        
            if (!$row) 
            {
                throw new RecordNotFoundException('No Record Found');
            }

        return new self($row);
    }

    public function getComments($offset, $limit)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC LIMIT {$offset}, {$limit}", array($this->id));
        
            foreach ($rows as $row) 
            {
                $comments[] = new Comment($row);
            }

        return $comments;
    }

    public function write(Comment $comment)
    {

        if(!$comment->validate())
        {
            throw new ValidationException('Invalid Comment');
        }

        $db = DB::conn();
        $db->query(
            'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()',
                array($this->id, $comment->username, $comment->body)
        );     
    }

    //This is supposed to get the thread's category values
    public static function category($category_name){
        
        $db = DB::conn();
        $row = $db->row("SELECT category_name FROM category 
                WHERE category_name = ?", array($category_name)); 
        
        if (!$row) {
            throw new RecordNotFoundException('no record found');
            }
        return new self($row);
        }    
}