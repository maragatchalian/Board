<?php
class ThreadController extends AppController {

  const MAX_THREAD_PER_PAGE = 7;
  const MAX_COMMENT_PER_PAGE = 5;
  
  /*
  * Create new thread
  * :: - STATIC FUNCTION, can be called from the class name
  * -> - INSTANCE, can only be called from an instance of the class.
  */
  public function create()
  {
    $thread = new Thread();
    $comment = new Comment();
    $current_page = Param::get('page_next', 'create');
      
    switch ($current_page) {
      case 'create':
        break;
      
      case 'create_end':
        $thread->title = Param::get('title');
        $comment->username = Param::get('username');
        $comment->body = Param::get('body');
 
        try 
          {
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
 
  //Displays all the threads
  public function index() 
  {
    $per_page = self::MAX_THREAD_PER_PAGE; 
    $current_page = Param::get('page', 1);
    $pagination = new SimplePagination($current_page, $per_page) ;

    $threads = Thread::getAll($pagination->start_index -1, $pagination->count + 1);
    $pagination->checkLastPage($threads);

    $total = Thread::CountAll();
    $pages = ceil($total / $per_page);
    
    $this->set(get_defined_vars()); 
  }   

  //Displays all the comments (depends on what thread you clicked)
  public function view() 
  {
    $per_page = self::MAX_COMMENT_PER_PAGE;
    $page = Param::get('page', 1);
    $pagination = new SimplePagination($page, $per_page) ;

    $thread = Thread::get(Param::get('thread_id'));
    $comments = $thread->getComments($pagination->start_index -1, $pagination->count + 1);
        
    $pagination->checkLastPage($comments);
    $total = $thread->countComments();
    $pages = ceil($total / $per_page);
    $this->set(get_defined_vars());
  }

//Write a new comment
  public function write()
  {
    $thread = Thread::get(Param::get('thread_id'));
    $comment = new Comment();
    $page = Param::get('page_next', 'write');

    switch($page) { 
      case 'write':
      break;

      case 'write_end':                
        $comment->username = Param::get('username');
        $comment->body = Param::get('body');
          
        try 
        {            
          $thread->write($comment);
        } catch (ValidationException $e) {                    
          $page = 'write';
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
?>
