<?php
class ThreadController extends AppController {
    const ITEMS_PER_PAGE = 5;

//Create a new comment (Thread)
public function create(){

        $thread = new Thread();
        $comment = new Comment();
        $page = Param::get('page_next', 'create');
        
        switch ($page) {
 	         case 'create':
           break;
          
           case 'create_end':
            $thread->title = Param::get('title');
            $comment->username = Param::get('username');
	          $comment->body = Param::get('body');
 
           try {
               $thread->create($comment);
               } catch (ValidationException $e) {
               $page = 'create';
            }
           break;
           
	         default:
            throw new NotFoundException("{$page} is not found");
            break;
    	   }	

       $this->set(get_defined_vars());
       $this->render($page);
    }
 

//Instance of the Thread model, and its static functions getAll()
public function index() {
    $threads = Thread::getAll();
    $this->set(get_defined_vars());
    }   

//View function
public function view() {

        $thread = Thread::get(Param::get('thread_id'));
        $comments = $thread->getComments();
        $this->set(get_defined_vars());
        }


public function write(){
                    
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next', 'write');

        switch($page) { 
          case 'write':
          break;

          case 'write_end':                
            $comment->username = Param::get('username');
            $comment->body = Param::get('body');
          
          try {            
              $thread->write($comment);
              } 
          
          catch (ValidationException $e) {                    
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
