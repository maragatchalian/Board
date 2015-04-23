<?php

class ThreadController extends AppController {

/*
* Create new thread
* :: - STATIC FUNCTION, can be called from the class name
* -> - INSTANCE, can only be called from an instance of the class.
*
* Everything inputted on the form (view/thread/create.php) will be gathered by this function
*/

    public function create() 
    {
        $thread = new Thread();
        $comment = new Comment();
        $current_page = Param::get('page_next', 'create');   
                    
        switch ($current_page) { 
            case 'create':
                break;
            /*  
            *   After the user clicked on submit, the page will be redirected to 'create_end'
            *   From the $thread database, this will get the title.. and so on. 
            *   after all, controllers are all about getting the inputted data.
            *   then the data gathered here will be tranferred to view (view/thread/view.php)
            */
            case 'create_end':

                $thread->title = Param::get('title'); 
                $thread->category = Param::get('category');
                $thread->user_id = $_SESSION['user_id'];
                $comment->body = Param::get('body');
               // $comment->username = Param::get('username');
                $comment->user_id = $_SESSION['user_id'];
                
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $current_page = 'create';
                }
                break;
            default:
                throw new NotFoundException("{$current_page} is not found");
                break;
            }  

        $this->set(get_defined_vars());
        $this->render($current_page);               
    }
          
    //Displays the comments of the thread
    public function view() 
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);      

        $thread_id = Param::get('thread_id'); 
        $thread = Thread::get($thread_id); 
        $comments = Comment::getAll($pagination->start_index -1, $pagination->count + 1, $thread_id);
                        
        $total = Comment::countAll($thread_id);
        $pagination->checkLastPage($comments);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    }

    public function delete_thread() 
    { 
        $thread = Thread::get(Param::get('thread_id'));
        $thread->deleteThread($_SESSION['user_id']);
        $this->set(get_defined_vars());
        $this->render('thread/delete_thread');
    }  

    /*
    * Sorting of threads
    */

    //All Threads
    public function index() 
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);
        $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
        $pagination->checkLastPage($threads);
        $total = Thread::CountAll();
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars()); 
    }  

    public function mythreads()
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $id = $_SESSION['user_id'];
        $threads = Thread::getAllMyThread($pagination->start_index -1, $pagination->count + 1, $id);
        $pagination->checkLastPage($threads);

        $total = Thread::countAllThreadByUserId($_SESSION['user_id']);
        $pages = ceil($total / $per_page);

        $this->set(get_defined_vars());
        $this->render('my_threads');
    }

    public function bycategory() 
    {
        $category = Param::get('category','none');
            if ( $category !== 'none') {
                $per_page = MAX_DATA_PER_PAGE;
                $current_page = Param::get('page', 1);
                $pagination = new SimplePagination($current_page, $per_page);

                $threads = Thread::getByCategory($pagination->start_index -1, $pagination->count + 1, $category);
                $pagination->checkLastPage($threads);

                $total = Thread::countAllThreadByCategory($category);
                $pages = ceil($total / $per_page);
                $this->set(get_defined_vars());
                $this->render('sub_category');
        
            } else {
                $categories = Thread::getAllCategory();
                $this->set(get_defined_vars());
                $this->render('categories');
            }
        }    

    public function sub_category() 
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);
        $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
        $pagination->checkLastPage($threads);
        $total = Thread::countAll();
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars()); 
    }  
} //end


