<?php

class User extends AppModel {
//The following constants are declared to avoid magic numbers
    const MIN_USERNAME_LENGTH = 2;
    const MIN_FIRST_NAME_LENGTH = 2;
    const MIN_LAST_NAME_LENGTH = 2;
    const MIN_EMAIL_LENGTH = 4;
    const MIN_PASSWORD_LENGTH = 8;

    const MAX_USERNAME_LENGTH = 20;
    const MAX_FIRST_NAME_LENGTH = 30;
    const MAX_LAST_NAME_LENGTH = 30;
    const MAX_EMAIL_LENGTH = 30;
    const MAX_PASSWORD_LENGTH = 20;

    public $is_validated = true;

/*
*Registration Length Validation.
*to make sure that a specific field is only limited 
*   to a specific number of characters.
*/
    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_USERNAME_LENGTH, self::MAX_USERNAME_LENGTH,
            ),

            'exist' => array(
                'is_username_exist', 
                )
        ),

        'first_name' => array(
            'length' => array(
                'validate_between', self::MIN_FIRST_NAME_LENGTH, self::MAX_FIRST_NAME_LENGTH,
             )
        ),
        
        'last_name' => array(
            'length' => array(
                'validate_between', self::MIN_LAST_NAME_LENGTH, self::MAX_LAST_NAME_LENGTH,
            )
        ),

        'email' => array(
            'length' => array(
                'validate_between', self::MIN_EMAIL_LENGTH, self::MAX_EMAIL_LENGTH,
            ),

        'exist' => array(
            'is_email_exist',
            )
        ),

        'password' => array(
            'length' => array(
                'validate_between', self::MIN_PASSWORD_LENGTH, self::MAX_PASSWORD_LENGTH,
            )
        ),
        'confirm_password' => array(
            'match' => array(
                'is_password_match',
            )
        ),
    );

    public function register()
    {
        if (!$this->validate()) {
            throw new ValidationException('Invalid Input!');
        }

        try {
            $db = DB::conn(); 
            $db->begin();
            $params = array( //what is to be inserted when $params is called
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => strtolower($this->email),
                'password' => md5($this->password)
            );
            $db->insert('user', $params); //to insert values of $params in table 'user'
            $db->commit();
        } catch(Exception $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function login() 
    {
        $db = DB::conn();
        $params = array(
            'username' => $this->username,
            'password' => md5($this->password)
        );
        
        $user = $db->row("SELECT id, username FROM user WHERE BINARY username = :username AND BINARY password = :password", $params);

            if(!$user)  {
                $this->is_validated = false; 
                throw new RecordNotFoundException('No Record Found');
            }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }

    public function is_password_match()
    {
        return $this->password == $this->confirm_password;
    }

    public function is_username_exist()
    {
        $db = DB::conn();
        $username_exist = $db->row("SELECT username FROM user WHERE username = ?", array($this->username));
        return (!$username_exist);
    }
  
    public function is_email_exist()
    {
        $db = DB::conn();
        $username_exist = $db->row("SELECT email FROM user where email = ?", array($this->email));
        return (!$username_exist);
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

    public function update()
    {
         if (!$this->validate()) {
            throw new ValidationException('Invalid user credentials');
        }

        try {
            $db = DB::conn();
            $db->begin();
            $db->update(
                'user', array(
                    'username' => $this->username,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => strtolower($this->email)
                    ),
                array('id' =>$this->user_id) 
                );
            $db->commit();
        }catch(Exception $e) {
            $db->rollback();
            throw $e;
        }
    }

    public static function getOtherUsers($id) 
    {
        $users = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM user where id != ?", array($id));
            
            foreach($rows as $row) {
                $users[] = new self($row);
            }
        return $users;
    }

    /*
    *Follow and Unfollow
    */
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
       
    public static function getAllFollowing($user_id) 
    {
        $following = array();
        $db = DB::conn();
                        
        $rows = $db->rows('SELECT * FROM follow WHERE user_id = ?', array($user_id));

            foreach($rows as $row) {
                $following[] = new self($row);
            }
        return $following;
    }
} //end