<font color = 'black'>
<br />
<br />
<center>
<h1>Following</h1>
<br /> 
</center>

<ul style="list-style-type:square">
<?php foreach ($following as $get_from_following): ?>
    <li>
       
        <a href="<?php eh(url('follow/others_profile', array('user_id' => $get_from_following->user_id))) ?>">       

         <?php eh($get_from_following->username) ?> </a>         
    
    </li>
<?php endforeach; ?>


 
<?php if(empty($following)): ?>
       You are not following any users.
<?php endif ?>
<br />
<br />


<!--Pagination --> 
<?php if($pagination->current > 1): ?>
    <a class ="btn btn-small" href='?page=<?php echo($pagination->prev) ?>'>Previous</a>
        <?php else: ?> 
            Previous
        <?php endif ?>

<?php for($i = 1; $i <= $pages; $i++): ?>
    <?php if($i == $current_page): ?>
      <?php echo $i ?>
    <?php else: ?>
        <a class ="btn btn-small" href='?page=<?php echo $i ?>'><?php echo $i ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if(!$pagination->is_last_page): ?>
    <a class ="btn btn-small" href='?page=<?php echo $pagination->next ?>'>Next</a>
    <?php else: ?>  Next
<?php endif ?>

</ul>
</font>