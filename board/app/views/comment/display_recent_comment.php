<html>
<br />
<br />
<center>
<font color ="black">
    <h1>NEWSFEED</h1>
</center>

<?php foreach ($following as $get_from_follow): ?>
    <?php foreach ($comments as $comment): ?>
    <ul>
        <div class ="comments">
        <div class ="content">
            <a href="<?php readable_text(url('follow/others_profile', array('user_id' => $comment->user_id))) ?>">
        <h5><?php readable_text($comment->username) //username ?> </h5> </a>
         
            commented: <?php readable_text($comment->body) //comment ?> 
        <br />
        <?php echo time_difference($comment->created) ?> </em>  
        <br />
        <br />
    </ul>

    <?php endforeach; ?> 
<?php endforeach; ?> 

<?php if(empty($home)): ?>
No threads available.
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

</font>
</html>
</div>
</div>
