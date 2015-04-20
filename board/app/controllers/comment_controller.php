<?php

class CommentController extends AppController {

const MAX_COMMENT_PER_PAGE = 5;
const MAX_DATA_PER_PAGE = 5;

    public function write() 
    {
        $thread_id = Param::get('thread_id');
        $thread = Thread::get($thread_id);
        $comment = new Comment();
        $current_page = Param::get('page_next', 'write');

        switch($current_page) { 
            case 'write':
                break;
        
            case 'write_end':                
                $params = array(
                'body' => Param::get('body'),
                'username' => Param::get('username'),
                'user_id' => $_SESSION['user_id']
                );
                $comment = new Comment($params);
                
                try {            
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

    public function delete() 
    { 
        $comment = Comment::get(Param::get('comment_id'));
        $comment->delete($_SESSION['user_id']);
        $this->set(get_defined_vars());
        $this->render('comment/delete');
    }  

    public function favorites() 
    { 
        $per_page = self::MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $id = $_SESSION['user_id'];
        $favorites = Comment::getAllFavorites($pagination->start_index -1, $pagination->count + 1, $id);
        
        $pagination->checkLastPage($favorites);
        $total = Comment::pagination($id);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    }
            
    public function setFavorite() 
    {
        $comment = Comment::get(Param::get('comment_id'));
        $comment->user_id = $_SESSION['user_id']; 
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
        redirect(url('thread/view', array('thread_id' => $comment->thread_id)));
    }
} //end