<font color = "black">

<!--View Other User Profile-->

 <!-- Follow/Unfollow User -->
<?php if (!$users->isUserFollow()) : ?> 
	<a href="<?php eh(url('user/setFollowing', array('user_id' => $users->id, 'method' => 'add')))?>"> Follow</a>
<?php else : ?>
	<a href="<?php eh(url('user/setFollowing', array('user_id' => $users->id, 'method' => 'remove')))?>">Unfollow</a>
<?php endif ?>

<h3><?php eh($user->username) ?></h3>
<li> First Name: <h7><?php eh($user->first_name) ?></h7> <br/> </li>
<li> Surname: <h7><?php eh($user->last_name) ?></h7> <br/> </li>
<li> Email: <h7><?php eh($user->email) ?></h7> </li>
</font>