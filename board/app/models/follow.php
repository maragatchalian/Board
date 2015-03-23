<?php

class Follow extends AppModel {


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