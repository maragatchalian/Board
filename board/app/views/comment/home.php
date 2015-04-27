<html>
<br />
<br />
<center>
<font color ="black">
<h1>NEWSFEED</h1>
</center>

<?php foreach ($home as $get_from_home): ?>
	<?php foreach ($comments as $comment): ?>
   		<li>
        	<?php eh($get_from_home->username) //username ?> 
       		 <br />
        	commented: <?php eh($comment->body) //comment ?> 
        	<br />
        	<?php echo time_difference($comment->created) ?> </em>  
        	<br />
        	<br />
    </li>
	<?php endforeach; ?> 
<?php endforeach; ?> 

<!--Pagination --> 
<?php if($pagination->current > 1): ?>
    <a class ="btn btn-small" href='?thread_id=<?php eh($thread->id) ?>&page=<?php echo $pagination->prev ?>'>Previous</a>
    <?php else: ?> 
         Previous
    <?php endif ?>

<?php for($i = 1; $i <= $pages; $i++): ?>
    <?php if($i == $current_page): ?>
      <?php echo $i ?>
    <?php else: ?>
        <a class ="btn btn-small" href='?thread_id=<?php eh($thread->id) ?>&page=<?php echo $i ?>'><?php echo $i ?></a>
    <?php endif; ?>
<?php endfor; ?>

<?php if(!$pagination->is_last_page): ?>
    <a class ="btn btn-small" href='?thread_id=<?php eh($thread->id) ?>&page=<?php echo $pagination->next ?>'>Next</a>
    <?php else: ?>  Next
<?php endif ?>


</font>
</html>
