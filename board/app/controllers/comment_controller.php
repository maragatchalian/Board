<?php
class CommentController extends AppController {


/*
* 
* set Favorite and unfavorite
*
*/
    public function setFavorite(){
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
        redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id']))); 
    }

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

     public function delete() {
        $comments = new Comment();
        $user_id = $_SESSION['user_id'];
        $comment_id = Param::get('comment_id');
        if (!$comment_id) {
        redirect('thread/index');
        }
        try {
            $comment = Comment::get($comment_id);
            if ($comment->user_id == $_SESSION['userid']) {
            $comments->delete($comment_id);
        }
        } catch (ValidationException $e) {
            throw new NotFoundException('Comment not found');
        }
        $this->set(get_defined_vars());
        redirect(url('thread/view', array('thread_id' => $thread_id)));
}





}