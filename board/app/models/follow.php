<?php

class Follow extends AppModel {

    public static function getOtherUsers($offset, $limit, $id)
    {
        $users = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM user where id != ? LIMIT {$offset}, {$limit}", array($id));
            
        foreach($rows as $row) {
            $users[] = new self($row);
        }

        return $users;
    }

    public static function get($user_id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM user WHERE id = ?', array($user_id));
        return $row;
    } 

    public static function getData($user_id)
    {
        $db = DB::conn();
        $row = $db->row("SELECT * FROM user WHERE id = ?", array($user_id));

        if (!$row) {
            throw new RecordNotFoundException('no record found');
        }
        return new self($row);
    }

/******************************************************************************|
|=> ABOVE CODES NEEDS TO BE EDITED SINCE IT'S GETTING DATA FROM THE USER MODEL
|******************************************************************************|
|=> BELOW CODES ARE OKAY. IT'S GETTING DATA FROM FOLLOW MODEl
|******************************************************************************/

    public function countOtherUsers($user_id)
    {
        return User::countOtherUser($this->user_id); 
    }
    
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

    public static function countFollowing($user_id)
    {
        $db = DB::conn();
        $total_following = $db->value('SELECT COUNT(*) FROM follow WHERE user_id = ?', array($user_id));
        return $total_following;
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
} //end