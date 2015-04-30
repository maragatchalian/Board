<?php

class FavoriteController extends AppController {

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
 }