<html>
<body>
<font color ='black'>
<br />
<br />
    <h1> Other Users </h1> 
    <br />        
    <ul style="list-style-type:square">
        <?php foreach ($users as $get_from_user): ?>
            <li> 
                <a href="<?php eh(url('follow/others_profile', array('user_id' => $get_from_user->id))) ?>">
                <?php eh($get_from_user->username) ?></a>   
            </li>
        <?php endforeach; //Display contents of individual user ?>       

<!--Pagination --> 
<ul class="pagination">
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
  
</body>
</font>
</html>