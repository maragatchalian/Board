<?php

class FollowController extends AppController {

    public function following() {

        $user = User::get();
        $following = Follow::getAllFollowing();
        $this->set(get_defined_vars());  
    }

    public function setFollowing() {
        $follow = Follow::get(Param::get('user_id'));
        $method = Param::get('method');
        
        switch ($method) {
            case 'add':
                $comment->addFollowing();
                break;
            case 'remove':
                $comment->removeFollowing();
                break;
        default:
            throw new InvalidArgumentException("{$method} is an invalid parameter");
            break;
        }
        //redirect(url('thread/view', array('thread_id' => $_SESSION['thread_id'])));
        redirect(url('thread/view', array('thread_id' => $comment->thread_id)));
    }
}//end