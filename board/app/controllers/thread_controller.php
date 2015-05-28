<?php

class ThreadController extends AppController
{
    const CREATE_THREAD = 'create';
    const CREATE_THREAD_END = 'create_end';

    public function create()
    {
        $thread = new Thread();
        $comment = new Comment();
        $current_page = Param::get(PAGE_NEXT, self::CREATE_THREAD);
                    
        switch ($current_page) { 
            case self::CREATE_THREAD:
                break;

            case self::CREATE_THREAD_END:
                $thread->title = Param::get('title'); 
                $thread->category = Param::get('category');
                $thread->user_id = $_SESSION['user_id'];
                $comment->body = Param::get('body');
                $comment->user_id = $_SESSION['user_id'];
                $comment->username = $_SESSION['username'];
          
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $current_page = self::CREATE_THREAD;
                }
                break;
                
            default:
                throw new NotFoundException("{$current_page} is not found");
                break;
        }  

        $this->set(get_defined_vars());
        $this->render($current_page);
    }
              
    /*
    *Displays the comments of the thread
    */
    public function view() 
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get(PAGE, 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $thread_id = Param::get('thread_id'); 
        $thread = Thread::get($thread_id); 
        $comments = Comment::getAll($pagination->start_index -1, $pagination->count + 1, $thread_id);
       
        $total = Comment::countAll($thread_id);
        $pagination->checkLastPage($comments);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    }

    public function delete() 
    { 
        $thread = Thread::get(Param::get('thread_id'));
        $thread->delete($_SESSION['user_id']);
        $this->set(get_defined_vars());
    }  

    public function index() 
    {
        $user_id = Param::get('user_id');
          
        if  ($user_id == NULL) {
            $per_page = MAX_DATA_PER_PAGE;
            $current_page = Param::get(PAGE, 1);
            $pagination = new SimplePagination($current_page, $per_page); 
            $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1, $user_id);
            $pagination->checkLastPage($threads);
            $total = Thread::countAll();
            $pages = ceil($total / $per_page);
            $this->set(get_defined_vars()); 
            

        } else {       
            $user_id = $_SESSION['user_id']; 
            $per_page = MAX_DATA_PER_PAGE;
            $current_page = Param::get(PAGE, 1);
            $pagination = new SimplePagination($current_page, $per_page);
            $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1, $user_id);
            $pagination->checkLastPage($threads);
            $total = Thread::countAllThreadByUserId($user_id);
            $pages = ceil($total / $per_page);
            $this->set(get_defined_vars());
            
        }
    }  

    public function display_category() 
    {
        $category = Param::get('category','none');
        if ( $category !== 'none') {
            $per_page = MAX_DATA_PER_PAGE;
            $current_page = Param::get(PAGE, 1);
            $pagination = new SimplePagination($current_page, $per_page);

            $threads = Thread::getByCategory($pagination->start_index -1, $pagination->count + 1, $category);
            $pagination->checkLastPage($threads);

            $total = Thread::countAllThreadByCategory($category);
            $pages = ceil($total / $per_page);
            $this->set(get_defined_vars());
            $this->render('display_by_category');
        
        } else {
            $categories = Thread::getAllCategory();
            $this->set(get_defined_vars());
            $this->render('categories');
        }
    }    

    /*
    *Displays the list of threads under chosen categoty
    */
    public function display_by_category() 
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get(PAGE, 1);
        $pagination = new SimplePagination($current_page, $per_page);
        $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
        $pagination->checkLastPage($threads);
        $total = Thread::countAll();
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars()); 
    }  
} 