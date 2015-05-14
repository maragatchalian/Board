<?php

class UserController extends AppController 
{

const LOGIN_PAGE = 'login';
const HOME_PAGE = 'home';
const REGISTER = 'register';
const REGISTER_END = 'register_end';
const EDIT = 'edit';
const EDIT_END = 'edit_end';
const EDIT_BIO = 'edit_bio';
const EDIT_BIO_END = 'edit_bio_end';

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
            'bio' => Param::get('bio'),
            'confirm_password' => Param::get('confirm_password')
        );

        $user = new User($params);
        $page = Param::get(PAGE_NEXT, self::REGISTER);
        
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
        $page = Param::get(PAGE_NEXT, self::LOGIN_PAGE);
       
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
        $page = Param::get(PAGE_NEXT, self::EDIT);
                
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

    public function edit_bio() 
    {      
        $params = array(
            'bio' => Param::get('bio'),
            'user_id' => $_SESSION['user_id']
        );

        $user = new User($params);
        $page = Param::get(PAGE_NEXT, self::EDIT_BIO);
                
        switch ($page) {
            case self::EDIT_BIO:
                break;
            
            case self::EDIT_BIO_END:
                try {
                     $user->update();
                }catch (ValidationException $e) {
                    $page = self::EDIT_BIO;
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
}//end

