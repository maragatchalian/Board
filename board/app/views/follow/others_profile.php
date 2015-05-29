 <!-- Follow/Unfollow User -->
 <font color = "black">
 <br /> 
<?php if ($user->isUserFollowing($_SESSION['user_id'])) :?> 	         
    <a href="<?php readable_text(url('follow/set_following', array('user_id' => $user->id, 'method' => 'add')))?>"> 
        <span class ="icon-plus"></span></a> Follow
<?php else : ?>
    <a href="<?php readable_text(url('follow/set_following', array('user_id' => $user->id, 'method' => 'remove')))?>" class = "red">
        <i class ="icon-minus icon-red"></i></a> Unfollow
<?php endif ?>

<!--Other user profile information-->
<h4><?php readable_text($user->username);?>'s profile</h4>
<form class="span6 well shadow" method="POST">

<label>First name</label>
<input class="span6" type="text" value="<?php readable_text($user->first_name) ?>" name="firstname" disabled> <br />
<label>Last name</label>
<input class="span6" type="text" value="<?php readable_text($user->last_name) ?>" name="lastname" disabled> <br />
<label>Username</label>
<input class="span6" type="text" value="<?php readable_text($user->username) ?>" name="username" disabled> <br />
<label>Email</label>
<input class="span6" type="email" value="<?php readable_text($user->email) ?>" name="email" disabled> 
<br/>
</font>
</form>