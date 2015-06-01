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

<div class = "profile_info">
    <b>Username: </b> <?php readable_text($user->username) ?> <br />
    <b>First Name: </b> <?php readable_text($user->first_name) ?> <br />
    <b>Last Name:</b>  <?php readable_text($user->last_name) ?><br />
    <b>Email:</b>    <?php readable_text($user->email) ?><br />
</div>
</font>
</form>