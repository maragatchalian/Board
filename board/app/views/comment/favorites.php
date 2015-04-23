<html>
<font color ='black'>
<center> 
<br />
<br />
<h1> My Favorite Comments </h1>
</center>
<ul style="list-style-type:square">
<br />

<?php if (empty($favorites)): ?>
       You have no favorites.
<?php endif ?>
<br />

<?php foreach ($favorites as $get_from_favorite): ?>
    <li>
        <?php eh($get_from_favorite->comment_body) ?></a> 
        <br /> 
        By: <?php eh($get_from_favorite->username) ?></a>
        <br /> 
        <br />                  
        </li>
    <?php endforeach; //Display contents of individual thread to href to A tag ?>
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