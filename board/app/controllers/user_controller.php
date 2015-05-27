<?php

class UserController extends AppController
{
    const LOGIN_PAGE = 'login';
    const HOME_PAGE = 'home';
    const REGISTER = 'register';
    const REGISTER_END = 'register_end';
    const EDIT = 'edit';
    const EDIT_END = 'edit_end';
    const EDIT_PASSWORD = 'edit_password';
    const EDIT_PASSWORD_END = 'edit_password_end';

    public function register() 
    {
        $params = array(
            'username' => Param::get('username'),
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
            'email' => Param::get('email'),
            'password' => Param::get('password'),
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
            'new_username' => Param::get('username'),
            'first_name' => Param::get('first_name'),
            'last_name' => Param::get('last_name'),
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
                     $success = true;
                }catch (ValidationException $e) {
                    $page = self::EDIT;
                    $success = false;
                }

                if ($success) {
                    $_SESSION['username'] = $user->new_username;
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

    public function edit_password() 
    {
        $params = array(
            'password' => Param::get('password'),
            'confirm_password' => Param::get('confirm_password'),
            'user_id' => $_SESSION['user_id'] 
        );

        $user = new User($params);
        $page = Param::get(PAGE_NEXT, self::EDIT_PASSWORD);
        
        switch ($page) {    
            case self::EDIT_PASSWORD:
                break;
            
            case self::EDIT_PASSWORD_END:
                try {
                    $user->editPassword();
                } catch (ValidationException $e) {
                    $page = self::EDIT_PASSWORD;
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }
}