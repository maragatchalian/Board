<?php

class FollowController extends AppController
{
    /*
    * Follow/Unfollow user on their profile
    */
    public function others_profile()
    {
        $user_id = Param::get('user_id');
        $row = User::get($user_id);
        $user = new Follow($row);
        $user->user_id = $_SESSION['user_id'];
        $this->set(get_defined_vars());  
    }

    /*
    * Following and Unfollowing a User
    */
    public function following() 
    { 
        $per_page = MAX_DATA_PER_PAGE;
        $current_page = Param::get(PAGE, 1);
        $pagination = new SimplePagination($current_page, $per_page);
       
        $user_id = $_SESSION['user_id'];
        $following = Follow::getAll($pagination->start_index -1, $pagination->count + 1, $user_id);
       
        $pagination->checkLastPage($following);
        $total = Follow::countFollowing($user_id);
        $pages = ceil($total / $per_page);
        $this->set(get_defined_vars());
    }

    public function set_following() 
    {
        $follow = Follow::getDataByUserId(Param::get('user_id'));
        $follow->user_id = $_SESSION['user_id']; 
        $method = Param::get('method');
                
        switch ($method) {
            case 'add':
                $follow->addFollowing();
                break;
            case 'remove':
                $follow->removeFollowing();
                break;
        default:
            throw new InvalidArgumentException("{$method} is an invalid parameter");
            break;
        }
    redirect(url('follow/others_profile', array('user_id' => $follow->id)));
    }
}