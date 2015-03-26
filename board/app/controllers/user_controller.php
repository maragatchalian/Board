<?php

class UserController extends AppController{

    public function register() {
        if (is_logged_in()) {
            redirect(url('user/home'));
        }

        $params = array(
            'username' => Param::get('username'),
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
            'email' => Param::get('email'),
            'password' => Param::get('password'),
            'confirm_password' => Param::get('confirm_password')
        );

        $user = new User($params);
        $page = Param::get('page_next', 'register');
        
        switch ($page) {    
            case 'register':
            break;
            
            case 'register_end':
                try {
                    $user->register();
                } catch (ValidationException $e) {
                    $page = 'register';
                }

            break;
            default:
                throw new NotFoundException("{$page} is not found");
            break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function login() {
        if (is_logged_in()) {
            redirect(url('user/home'));
        }

        $params = array(
            'username' => trim(Param::get('username')),
            'password' => Param::get('password')
        );

        $user = new User($params);
        $page = Param::get('page_next', 'login');

            switch ($page) {
                case 'login':
                break;
         
                case 'home':
                    try {
                        $user->login();
                    }catch (ValidationException $e){
                        $page = 'login';
                    }
            
                break;
                default:
                    throw new NotFoundException("{$page} is not found");
                break;
            }
        
        $this->set(get_defined_vars());
        $this->render($page); 
    }
        
    public function logout() {
        session_destroy();
        redirect(url('user/login'));
    }
  
    //Display user's name, username, and email

    public function profile() {
        $user = User::getData($_SESSION['user_id']);
        $this->set(get_defined_vars());
    }


    public function home() {

    }

    public function edit() {
        $params = array(
            'username' => Param::get('username'),
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
            'email' => Param::get('email') 
        );

        $user = new User($params);
        $page = Param::get('page_next', 'edit');

        switch ($page) {
            case 'edit':
            break;

            case 'edit_end':
                try {
                     $user->update();
                }catch (ValidationException $e) {
                        $page = 'edit';
                     }
                break;
                default:
                    throw new NotFoundException("{$page} is not found");
                    break;
                }

        $this->set(get_defined_vars());
        $this->render($page); 
    }

    //View all users - user/users.php
    public function users() {
       $user_id = Param::get('user_id');
       $user = User::get($user_id);
       $users = User::getAllUsers();
       $this->set(get_defined_vars()); 
    }

    public function others() {
      
        $user_id = Param::get('user_id');   
        $user = new User;
        $row = User::get($user_id);

            foreach ($row as $key => $value) 
            {
                $user->$key = $value;
            }

        $this->set(get_defined_vars());
        
    }

    //Functions related to following/unfollowing a user.
    
    public function following() { //-J
        $user = User::getData($_SESSION['user_id']); //For Greeting Purposes. Fetch the Name of the user.
        $following = User::getAllFollowing();
        $username = Param::get('username');
        $this->set(get_defined_vars());
    }

    public function setFollowing() {
        $follow = User::getData(Param::get('user_id'));
        $method = Param::get('method');
        
        switch ($method) {
            case 'add':
                $follow->addFollowing();
                break;
            case 'remove':
                $follow->removeFollowing();
                break;
        default:
            throw new InvalidArgumentException("{$method} is an invalid parameter");
            break;
        }
        redirect(url('user/others', array('user_id' => $follow->id)));   
    }
}//end

