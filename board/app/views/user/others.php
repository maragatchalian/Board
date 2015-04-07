 <!-- Follow/Unfollow User -->
 <font color = "black">
 <br /> 
<?php if ($user->isUserFollowing()) : ?> 
    <a href="<?php eh(url('user/setFollowing', array('user_id' => $user->id, 'method' => 'add')))?>"> 
        <span class ="icon-plus"></span></a> Follow
<?php else : ?>
    <a href="<?php eh(url('user/setFollowing', array('user_id' => $user->id, 'method' => 'remove')))?>" class = "red">
        <i class ="icon-minus icon-red"></i></a> Unfollow
<?php endif ?>

<!--Other user profile information-->
<h4><?php eh($user->username);?>'s profile</h4>
<form class="span6 well shadow" method="POST">

<label>First name</label>
<input class="span6" type="text" value="<?php eh($user->first_name) ?>" name="firstname" disabled> <br />
<label>Last name</label>
<input class="span6" type="text" value="<?php eh($user->last_name) ?>" name="lastname" disabled> <br />
<label>Username</label>
<input class="span6" type="text" value="<?php eh($user->username) ?>" name="username" disabled> <br />
<label>Email</label>
<input class="span6" type="email" value="<?php eh($user->email) ?>" name="email" disabled> 
<br/>
</font>
</form>