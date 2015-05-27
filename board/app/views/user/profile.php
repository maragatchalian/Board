<html>
<br />
<br />
<font color ="black">
<h1>Hello, <?php eh($user->first_name) ?>!</h1>
<center class="profile">
<br />        
<br />   
<a class="btn btn-default btn-medium" href="<?php eh(url('favorite/display_user_favorite_comments')) ?>" 
    method="post"> <i class="icon-star"></i>Favorites</a>

<a class="btn btn-default btn-medium" href="<?php eh(url('follow/following')) ?>" 
    method="post"> <i class="icon-plus"></i>Following</a>     

<form action="<?php eh(url('thread/all_threads')) ?>" method="post">
    <input type="hidden" name="user_id" value="(PHP CODE GENERATED USER_ID)">
    <button class="btn btn-default btn-medium"><i class="icon-file"></i>My Threads</button>
</form>

<div class = "profile_info">
    <b>Username: </b> <?php eh($user->username) ?> <br />
    <b>First Name: </b> <?php eh($user->first_name) ?> <br />
    <b>Last Name:</b>  <?php eh($user->last_name) ?><br />
    <b>Email:</b>    <?php eh($user->email) ?><br />
    <br /><br />
</div>

<div>      
    <a class="btn btn-medium btn-info" href="<?php eh(url('user/edit')) ?>">Edit profile</a>    
    <a class="btn btn-medium btn-info" href="<?php eh(url('user/edit_password')) ?>">Edit Password</a>     
                 
</font>
</form>
</center>
</html>
