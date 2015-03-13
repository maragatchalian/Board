<?php

//Comment Validation
class Comment extends AppModel {
    const MIN_USERNAME_LENGTH = 1;
    const MIN_BODY_LENGTH = 1;

    const MAX_USERNAME_LENGTH = 20;
    const MAX_BODY_LENGTH = 200;

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

    public function favorite(){
        try {
            $db = DB::conn();
            $db->begin();
            $db->insert('favorite', array('comment_id' => $this->id , 'user_id' => $_SESSION['user_id'] ));
            $db->commit();
            } catch (Exception $e) {
            $db->rollback();
            }

        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id']))); 
     }

    public function unfavorite(){
        try {
            $db = DB::conn();
            $db->begin();
            $db->query('DELETE FROM favorite
                 WHERE comment_id = ? && user_id = ?', array($this->id, $_SESSION['user_id']));
            $db->commit();
            } catch (Exception $e) {
            $db->rollback();
    }

    redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id']))); 

    public function favorited(){
        $db = DB::conn();
        $favorited_comment = $db->row('SELECT * FROM favorite WHERE comment_id = ? && user_id = ?', array($this->id, $_SESSION['user_id']));
        
        return !$cfavorited_comment;
    }
}
?> 
