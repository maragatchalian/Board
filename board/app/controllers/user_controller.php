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

    //view all users
    public function users() {
       $user = User::get(); //name of user
       //$this->set(get_defined_vars());

        //$per_page = self::MAX_COMMENT_PER_PAGE; 
        //$current_page = Param::get('page', 1);
        //$pagination = new SimplePagination($current_page, $per_page);

        $users = User::getAllUsers();//($pagination->start_index -1, $pagination->count + 1);
        //$pagination->checkLastPage($threads);

        //$total = Comment::CountFavorite();
        //$pages = ceil($total / $per_page);
    
        $this->set(get_defined_vars()); 

    }

    //View other user page
    public function view() {
        $user = User::get();
        $users = $user->getAllUsers();
        $this->set(get_defined_vars());
        //$follow = $user::get(Param::get('follow_id'));

    } 

}//end

