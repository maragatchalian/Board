<html>
<br />
<br />
<center>
<font color ="black">
<h1>NEWSFEED</h1>
</center>
	<?php foreach ($home as $get_from_home): ?>
        <li>
            <?php eh($get_from_home->username) ?></a> 
            <br />
            posted: 
        </li>
			<br />
    <?php endforeach; //Display contents of individual thread to href to A tag ?>
</font>
</html>
