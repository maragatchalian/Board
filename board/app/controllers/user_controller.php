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
        if (is_logged_in()) 
        {
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
                    try 
                    {
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

    /*
    * Display user's name, username, and email
    */
    public function profile() {
        $user = User::get();
        $this->set(get_defined_vars());
    }

    public function home(){

    }

    public function edit(){
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
       $user = User::get();
       $users = User::getAllUsers();
       $this->set(get_defined_vars()); 

    }

    //View other users - user/view.php
    public function view() {
        $user = User::get();     
        $id = Param::get('user_id');
        $users = User::get($id);
        $user_get_all = User::getAllUsers($id);
        $this->set(get_defined_vars());
    }

    //--------------------------------------------------------
    public function following() {

        $user = User::get();
        $following = User::getAllFollowing();
        $this->set(get_defined_vars());  
    }

    public function setFollowing() {
        $follow = User::get(Param::get('id'));
        //$follow = User::getAllFollowing(Param::get('follow_id'));
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
        redirect(url('user/view'));//, array('user_id' => $_SESSION['user_id'])));
    }

}//end

