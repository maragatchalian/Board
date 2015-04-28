<?php

class UserController extends AppController {

const LOGIN_PAGE = 'login';
const HOME_PAGE = 'home';
const REGISTER = 'register';
const REGISTER_END = 'register_end';
const EDIT = 'edit';
const EDIT_END = 'edit_end';

    public function register() 
    {
        if (is_logged_in()) {
            redirect(url('comment/home'));
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
        $page = Param::get('page_next', self::REGISTER);
        
        switch ($page) {    
            case self::REGISTER:
                break;
            
            case self::REGISTER_END:
                try {
                    $user->register();
                } catch (ValidationException $e) {
                    $page = self::REGISTER;
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function login() 
    {
        if (is_logged_in()) {
            redirect(url('comment/home'));
        }

        $params = array(
            'username' => trim(Param::get('username')),
            'password' => Param::get('password')
        );

        $user = new User($params);
        $page = Param::get('page_next', self::LOGIN_PAGE);
       
        switch ($page) {
            case self::LOGIN_PAGE:
                break;
            case self::HOME_PAGE:
                try {
                    $user->login();
                }catch (ValidationException $e){
                    $page = self::LOGIN_PAGE;
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page); 
    }
        
    public function logout() 
    {
        session_destroy();
        redirect(url('user/login'));
    }
  
    /*
    * Displays own profile
    */
    public function profile() 
    {
        $user = User::getData($_SESSION['user_id']);
        $this->set(get_defined_vars());
    }

    public function edit() 
    {      
        $params = array(
            'username' => Param::get('username'),
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
            'password' => Param::get('password'),
            'user_id' => $_SESSION['user_id']
        );

        $user = new User($params);
        $page = Param::get('page_next', self::EDIT);
                
        switch ($page) {
            case self::EDIT:
                break;
            case self::EDIT_END:
                try {
                     $user->update();
                }catch (ValidationException $e) {
                    $page = self::EDIT;
                }
                break;
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }

        $user_edit = User::getData($_SESSION['user_id']);
        $this->set(get_defined_vars());
        $this->render($page); 
    }
/*
    /*
    * Displays list of users
    
    public function get_all_users() 
    { 
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $id = $_SESSION['user_id'];
        $users = User::getOtherUsers($pagination->start_index -1, $pagination->count + 1, $id);
        
        $pagination->checkLastPage($users);
        $total = User::pagination($id);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    } 

    /*
    * Displays profile of other users
    
    public function others_profile() 
    {
        $user_id = Param::get('user_id');
        $row = User::get($user_id); 
        $user = new User($row);
        $user->user_id = $_SESSION['user_id']; 
        $this->set(get_defined_vars());  
    }

    /*
    * Following and Unfollowing a User
    
    public function following() 
    { 
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $id = $_SESSION['user_id'];
        $following = User::getAllFollowing($pagination->start_index -1, $pagination->count + 1, $id);
        $pagination->checkLastPage($following);
        $total = User::countFollowing($id);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    }

    public function setFollowing() 
    {
        $follow = User::getData(Param::get('user_id'));
        $follow->user_id = $_SESSION['user_id']; 
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
        redirect(url('user/others_profile', array('user_id' => $follow->id)));   
    }*/
}//end

