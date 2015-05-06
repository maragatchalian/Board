<?php

class FavoriteController extends AppController 
{

 public function setFavorite()
    {
        $comment = Favorite::getDatabyCommentId(Param::get('comment_id'));
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

     /*
    * Displays list of user's favorite comments
    */
    public function favorites() 
    { 
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get('page', 1);
        $pagination = new SimplePagination($current_page, $per_page);

        $user_id = $_SESSION['user_id'];
        $favorites = Favorite::getAllFavorites($pagination->start_index -1, $pagination->count + 1, $user_id);

        $pagination->checkLastPage($favorites);
        $total = Favorite::countFavoriteByUserId($user_id);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    }
} //end