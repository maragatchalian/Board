<?php

class Follow extends AppModel {

    public function isUserFollow() {
        return $this->user_id === $_SESSION['user_id'];
    }

    public function addFollowing(){
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                'user_id' => $_SESSION['user_id']
            );
        
            $db->insert('follow', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

   public function removeFollowing() {
        try {
            $db = DB::conn();
            $db->begin();
            $params = array(
                $_SESSION['user_id']
            );
            $db->query('DELETE FROM follow WHERE user_id = ?', $params);
            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
        }
    }

        public function isUserFollowing() {
        $db = DB::conn();
        $params = array(
            $this->id,
            $_SESSION['user_id']
        );
        
        $user_following = $db->rows('SELECT * FROM follow
            WHERE id = ? AND user_id = ?', $params);
        return !$user_following;    
    }

    
    public static function countFollowing() {
        $db = DB::conn();
        $total_following = $db->value('SELECT COUNT(*) FROM follow
            WHERE id =?', array($this->id));
        
        return $total_following;
    }
       

    public static function getAllFollowing() {
        $following = array();
        $db = DB::conn();
                        
        $rows = $db->rows('SELECT * FROM follow
            WHERE user_id = ?', array($_SESSION['user_id']));

            foreach($rows as $row) {
            $following[] = new self($row);
         }
        return $following;
    }

       public static function getAllUsers($id) {
        $users = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM user WHERE id = ?", array($id));
            
            foreach($rows as $row) {
                $users[] = new self($row);
            }
        return $users;
    }
      
    /*public static function getAll($user_id) {
        $following = array();
        $db = DB::conn();
            $rows = $db->rows("SELECT * FROM follow
                WHERE user_id = ?", array($user_id));
            
            foreach($rows as $row) {
            $following[] = new self($row);
            }
        return $following;
    }*/

        /*public static function get($id) {
            $db = DB::conn();
            $row = $db->row("SELECT * FROM follow
                WHERE id = ?", array($id));

        if (!$row) {
                throw new RecordNotFoundException('no record found');
            }
            return new self($row);
        }*/

 }//end