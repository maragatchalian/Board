<?php

class Follow extends AppModel
{
    public function addFollowing()
    { 
        try {
            $db = DB::conn();
            $db->begin();

            $params = array(
                'username' => $this->username,
                'user_id' => $this->user_id
            );

            $db->insert('follow', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

    public function removeFollowing()
    {
        try {
            $db = DB::conn();
            $db->begin();

            $params = array(
                $this->username,
                $this->user_id
            );
            
            $db->query("DELETE FROM follow WHERE username = ? AND user_id = ?", $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }
   
    public static function getAll($offset, $limit, $user_id)
    {
        $follows = array();

        if (!is_int($offset) || !is_int($limit)) {
            throw new NotIntegerException; 
        }

        $db = DB::conn();
        $rows = $db->rows("SELECT * from follow WHERE user_id = ? LIMIT {$offset}, {$limit}", array($user_id));
        

        foreach ($rows as $follow) {
            $follows[] = new Follow($follow);
        }

        foreach ($follows as $follow) {
            $row = $db->row("SELECT * from user WHERE username = ? LIMIT {$offset}, {$limit}", array($follow->username));
            $follow->user_id = $row['id'];
        }
        return $follows;
    }

    public function isUserFollowing()
    {
        $db = DB::conn();
        $params = array(
            $this->username,
            $this->user_id
        );
        $user_following = $db->row("SELECT * FROM follow WHERE username = ? AND user_id = ?", $params);
        return !$user_following;
    }

    public static function getDataByUserId($user_id)
    {
       return new self(object_to_array(User::getData($user_id)));
    }

    public static function displayRecentComment($thread_id)
    {
         return new self(object_to_array(Comment::displayRecentComment($thread_id)));
    }

    public static function countFollowing($user_id)
    {
        $db = DB::conn();
        $total_following = $db->value("SELECT COUNT(*) FROM follow WHERE user_id = ?", array($user_id));
        
        return $total_following;
    }

    public static function countRecentComment($user_id) 
    {
        $db = DB::conn();
        $recent_comment = $db->value("SELECT COUNT(*) FROM follow WHERE user_id = ?", array($user_id));
        
        return $recent_comment;
    }
} 