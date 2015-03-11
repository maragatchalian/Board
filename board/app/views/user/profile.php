<html>
    <head>
        <br />
        <br />
        <center>
            <font color ="black">
                <h1>Hello, <?php eh($user->username) ?>!</h1> 
                <br />
                <a href="<?php eh(url('#')) ?>">Favorites</a>             
                <a href="<?php eh(url('#')) ?>">Following</a>
                <h3> Account </h3>
                First Name: <?php eh($user->first_name) ?> <br />
                Last Name: <?php eh($user->last_name) ?><br />
                Email: <?php eh($user->email) ?><br />

                <h3> Security </h3>
                **Password is hidden** <br />

                <button class="btn btn-info btn-medium" type="submit">Edit Profile</button>
                 </font>
        </center>
        </head>
    </body>
</html>
