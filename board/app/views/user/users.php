<html>
    <head> </head>
        <font color ='black'>
        <center> 
        <h1> All Users </h1>
        <br />
        <br />
        <center>

                <ul style="list-style-type:square">
                     <?php foreach ($users as $get_from_user): ?>
               <li> <a href="<?php eh(url('user/view', array('username' => $get_from_user->username))) ?>">
                <?php eh($get_from_user->username) ?></a>        
                </li>
                   <?php endforeach; //Display contents of individual user ?>
           
                </font>
        </center>
        </form>
    </body>
</html>