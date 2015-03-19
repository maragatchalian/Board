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
            $comment->username = Param::get('username');
            
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

    
    public function delete() { 
        $comment = Comment::get(Param::get('comment_id'));
        $this->set(get_defined_vars());
        $comment->deleteComment();
        $this->render('comment/delete');
    }  


    public function favorites() {
        $user = User::get();

        $this->set(get_defined_vars());
    }
    
    public function setFavorite() {
        $comment = Comment::get(Param::get('comment_id'));
        $method = Param::get('method');
        
        switch ($method) {
            case 'add':
                $comment->addFavorite();
                break;
            case 'remove':
                $comment->removeFavorite();
                break;
        default:
            throw new InvalidArgumentException("{$method} is an invalid parameter");
            break;
        }
        //redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));
        redirect(url('thread/view', array('thread_id' => $comment->thread_id)));
    }

} //end