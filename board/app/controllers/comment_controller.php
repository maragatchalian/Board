<?php
class CommentController extends AppController {

   //Write a new comment
    public function write() {
        $thread_id = Param::get('thread_id');
        $thread = Thread::get($thread_id);
        $comment = new Comment();
        $current_page = Param::get('page_next', 'write');

        switch($current_page) { 
            case 'write':
            break;

        case 'write_end':                
            $comment->body = Param::get('body');
            
            
            try 
            {            
               $comment->write($comment, $thread_id);
            } catch (ValidationException $e) {                    
                $current_page = 'write';
            }    

        break;
        default:
            throw new NotFoundException("{$current_page} is not found");
            break;
        }
    $this->set(get_defined_vars());
    $this->render($current_page);   
    }

    public function favorites() {
        
    }

    public function delete() { 
        $comment = Comment::get(Param::get('comment_id'));
        $this->set(get_defined_vars());
        $comment->deleteComment();
        $this->render('thread/index');
    }  

} //end