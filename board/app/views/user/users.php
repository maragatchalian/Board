<html>
<body>
<font color ='black'>
<center> 
<br />
<br />
    <h1> Other Users </h1> 
    <br />        
    <ul style="list-style-type:square">
        <?php foreach ($users as $get_from_user): ?>
            <li> 
                <a href="<?php eh(url('user/others', array('user_id' => $get_from_user->id))) ?>">
                <?php eh($get_from_user->username) ?></a>   
            </li>
        <?php endforeach; //Display contents of individual user ?>         
</center>
</body>
</font>
</html>