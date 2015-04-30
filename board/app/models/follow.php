<?php

class Follow extends AppModel {

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
            $db->query('DELETE FROM follow WHERE username = ? AND user_id = ?', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }
    
    public function isUserFollowing()
    {
        $db = DB::conn();
        $params = array(
            $this->username,
            $this->user_id
        );
        $user_following = $db->row('SELECT * FROM follow WHERE username = ? AND user_id = ?', $params);
        return !$user_following;
    }

    public static function getDataByUserId($user_id)
    {
       return new self(objectToArray(User::getData($user_id)));
    }

    public static function getAllFollowing($offset, $limit, $user_id)
    {
        $following = array();
        $db = DB::conn();
                        
        $rows = $db->rows("SELECT * FROM follow WHERE user_id = ? LIMIT {$offset}, {$limit}", array($user_id));

        foreach($rows as $row) {
            $following[] = new self($row);
        }
        return $following;
    }

    public static function countFollowing($user_id)
    {
        $db = DB::conn();
        $total_following = $db->value('SELECT COUNT(*) FROM follow WHERE user_id = ?', array($user_id));
        return $total_following;
    }

    public function countOtherUsers($user_id)
    {
        return User::countOtherUser($this->user_id);
    }
} //end