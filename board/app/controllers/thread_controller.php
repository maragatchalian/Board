<?php

class ThreadController extends AppController 
{

const CREATE_THREAD = 'create';
const CREATE_THREAD_END = 'create_end';

/*
* Create new thread
* :: - STATIC FUNCTION, can be called from the class name
* -> - INSTANCE, can only be called from an instance of the class.
*
* Everything inputted on the view will be gathered by this function
*/

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

    public function index() 
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get(PAGE, 1);
        $pagination = new SimplePagination($current_page, $per_page); 
        $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);   
        $pagination->checkLastPage($threads);
        $total = Thread::CountAll();
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars()); 
    }  

    public function my_threads()
    {
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get(PAGE, 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $id = $_SESSION['user_id'];
        $threads = Thread::getAllMyThread($pagination->start_index -1, $pagination->count + 1, $id);
        $pagination->checkLastPage($threads);

        $total = Thread::countAllThreadByUserId($_SESSION['user_id']);
        $pages = ceil($total / $per_page);

        $this->set(get_defined_vars());
        $this->render('my_threads');
    }

    public function by_category() 
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
        $current_page = Param::get(PAGE, 1);
        $pagination = new SimplePagination($current_page, $per_page);
        $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
        $pagination->checkLastPage($threads);
        $total = Thread::countAll();
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars()); 
    }  
} //end
