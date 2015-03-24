<html>
    <head> </head>
        <font color ='black'>
        <center> 
            <br />
            <br />
        <h1> All Users </h1> 
        <h3>Hello, <?php eh($user->first_name) ?>! </h3>
        <br />
        <br />
        Here's the list of all the users:
        <center>
                <ul style="list-style-type:square">
                    <?php foreach ($users as $get_from_user): ?>
                <li> 
                    <a href="<?php eh(url('user/view', array('user_id' => $get_from_user->id))) ?>">
                    <?php eh($get_from_user->username) ?></a>   
                </li>
                    <?php endforeach; //Display contents of individual user ?>
           
                </font>
        </center>
        </form>
    </body>
</html>