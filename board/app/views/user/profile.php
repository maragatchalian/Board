<html>
<br />
<br />
<font color ="black">
<h1>Hello, <?php eh($user->first_name) ?>!</h1>
<center class="profile">
<br /> 
 
<div class = buttons>               
<form action="<?php eh(url('comment/favorites')) ?>" method="post">
    <button class="btn btn-default btn-medium" type="submit"> <i class="icon-star"></i>Favorites</button>
    </form>

    <form action="<?php eh(url('user/following')) ?>" method="post">
    <button class="btn btn-default btn-medium" type="submit"> <i class="icon-plus"></i>Following</button>
    </form>
</div>
                           
<div class = "profile_info">
    <b>First Name: </b> <?php eh($user->username) ?> <br />
    <b>First Name: </b> <?php eh($user->first_name) ?> <br />
    <b>Last Name:</b>  <?php eh($user->last_name) ?><br />
    <b>Email:</b>    <?php eh($user->email) ?><br />
    <br /><br />
</div>
<div>      
    <a class="btn btn-medium btn-info" href="<?php eh(url('user/edit')) ?>">Edit profile</a>       
                 
</font>
</form>
</center>
</html>
