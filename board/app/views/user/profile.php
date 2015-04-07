<html>
    <head> </head>
        <br />
        <br />
        <font color ="black">
        <h1>Hello, <?php eh($user->first_name) ?>!</h1>
        <center class="profile">
        <br /> 
               
            <form action="<?php eh(url('comment/favorites')) ?>" method="post">
            <button class="btn btn-default btn-medium" type="submit"> <i class="icon-star"></i>Favorites</button>

            <form action="<?php eh(url('user/following')) ?>" method="post">
            <button class="btn btn-default btn-medium" type="submit"> <i class="icon-plus"></i>Following</button>

             <br />
            <br />
                
            <div class = "profile_info">
            <b>First Name: </b> <?php eh($user->first_name) ?> <br />
            <b>Last Name:</b>  <?php eh($user->last_name) ?><br />
            <b>Email:</b>    <?php eh($user->email) ?><br />
             <br />
            Security  <br />
            **Password is hidden** 
            </div>
            <div>
            <br />
            <form action="<?php eh(url('user/edit')) ?>" method="post">
            <button class="btn btn-info btn-medium" type="submit"> <i class="icon-user icon-white"></i> Edit Profile</button>

                 
            </font>
            </form>
        </center>
    </body>
</html>
