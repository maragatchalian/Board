<font color ="black">
    <br />
    <br />
    <h1><?php eh($category) ?></h1>
       
<ul style="list-style-type:square">
    <?php foreach ($threads as $thread): ?>
    <li>
    <a href="<?php eh(url('thread/view', array('thread_id' => $thread->id))) ?>">
    <?php eh($thread->title) ?></a>        
    </li>
    <?php endforeach; //Display contents of individual thread to href to A tag ?>

<!-- pagination -->
<br />
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
    <?php else: ?>
        Next
<?php endif ?>

<!--Create button--> 
<br />
<br />
<a class="btn btn-medium btn-info" href="<?php eh(url('thread/create')) ?>">Create Thread</a>

    </font>
</ul>