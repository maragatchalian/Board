 <!-- Follow/Unfollow User -->
<?php if ($users->isUserFollow()) : ?> 
    <a href="<?php eh(url('user/setFollowing', array('user_id' => $users->id, 'method' => 'add')))?>"> Follow</a>
<?php else : ?>
    <a href="<?php eh(url('user/setFollowing', array('user_id' => $users->id, 'method' => 'remove')))?>">Unfollow</a>
<?php endif ?>

<h2><?php eh($user['username'])?>'s profile</h2>
<form class="span6 well shadow" method="POST">
<label>First name</label>
<input class="span6" type="text" value="<?php eh($user['first_name']) ?>" name="firstname" disabled>
<label>Last name</label>
<input class="span6" type="text" value="<?php eh($user['last_name']) ?>" name="lastname" disabled>
<label>Username</label>
<input class="span6" type="text" value="<?php eh($user['username']) ?>" name="username" disabled>
<label>Email</label>
<input class="span6" type="email" value="<?php eh($user['email']) ?>" name="email" disabled>
<br/>
</form>