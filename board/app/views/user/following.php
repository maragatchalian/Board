<font color = 'black'>
<center>
	<br />
	<br />
<h1>Following</h1>

 <h3>Hello, <?php eh($user->first_name) ?>! </h3>
                <br /> 
                Here's the list of your following users:
                    <br /> 
                            
            <ul style="list-style-type:square">
            <?php foreach ($following as $get_from_following): ?>
            <li>
                <?php eh($get_from_following->username) ?></a>      
                   
            </li>
                 <?php endforeach; //Display contents of individual thread to href to A tag ?>
</font>
</center>