<?php
class ThreadController extends AppController {

    const MAX_THREAD_PER_PAGE = 5;
    const MAX_COMMENT_PER_PAGE = 5;
    /*
    * Create new thread
    * :: - STATIC FUNCTION, can be called from the class name
    * -> - INSTANCE, can only be called from an instance of the class.
    */

    /*
    *   Everything inputted on the form (view/thread/create.php) will be 
    *   gathered by this function
    */
    public function create() {
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
                $comment->body = Param::get('body');
                $comment->username = Param::get('username');
                
                try  {
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
        
    //Displays maximum number of threads per page
        public function index() {
            $per_page = self::MAX_THREAD_PER_PAGE; 
            $current_page = Param::get('page', 1);
            $pagination = new SimplePagination($current_page, $per_page);
            $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
            $pagination->checkLastPage($threads);
            $total = Thread::CountAll();
            $pages = ceil($total / $per_page);
            $this->set(get_defined_vars()); 
        }   

        
    //Displays the comments of the thread
    public function view() {
           
        //pagination
        $per_page = self::MAX_COMMENT_PER_PAGE;
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

    //sorting
    public function myThreads() {
        $per_page = self::MAX_THREAD_PER_PAGE; 
        $current_page = Param::get('page', 1);
        $id = $_SESSION['user_id'];
        $pagination = new SimplePagination($current_page, $per_page);

        $threads = Thread::getAllMyThread($pagination->start_index -1, $pagination->count + 1, $id);
        $pagination->checkLastPage($threads);

        $total = Thread::CountAll();
        $pages = ceil($total / $per_page);
        
        $this->set(get_defined_vars()); 
        $this->render('index');
    }


    public function byCategory() {
        $category = Param::get('category','none');
        if ( $category !== 'none') {
            $per_page = self::MAX_THREAD_PER_PAGE; 
            $current_page = Param::get('page', 1);
            $pagination = new SimplePagination($current_page, $per_page);

            $threads = Thread::getByCategory($pagination->start_index -1, $pagination->count + 1, $category);
            $pagination->checkLastPage($threads);

            $total = Thread::CountAll();
            $pages = ceil($total / $per_page);
            $this->set(get_defined_vars());
            $this->render('index');
        
        } else {
            $categories = Thread::getAllCategory();
            $this->set(get_defined_vars());
            $this->render('categories');
        }    
           
    }

} //end


