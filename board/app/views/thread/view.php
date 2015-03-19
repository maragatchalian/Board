<!--View thread and its comments --> 
<font color = "black">

<!--Thread Title-->
<center>
<h1><?php eh($thread->title) ?></h1>
</center>

<!--Spacing-->
 <div class="comment">                        
 <div class="meta">

<!--View Comments-->
<?php foreach($comments as $get_from_comment): ?>
   
<!--View Username-->
<h4> <ul style="list-style-type:square">
<li>  <?php eh($get_from_comment->username) ?> </li> </h4> 

 <!--View Date of Creation-->    
<?php eh($get_from_comment->created) ?> 

 <!--View Comment Body-->    
    <div><?php echo($get_from_comment->body) ?></div>
    <br /> 

<!-- Delete Comment -->
<?php if ($get_from_comment->isUserComment()) : ?> 
  <a href="<?php eh(url('thread/index', array('comment_id' => $get_from_comment->id)))?>"
  onclick="return confirm('Are you sure you want to delete this comment?')">
Delete this comment
</a>
<?php endif ?>

<?php endforeach ?>

</div> 
</div>
<br />

<!--Pagination --> 
<?php if($pagination->current > 1): ?>
    <a class ="btn btn-small" href='?thread_id=<?php eh($thread->id) ?>&page=<?php echo $pagination->prev ?>'>Previous</a>
    <?php else: ?> 
         Previous
    <?php endif ?>

<?php for($i = 1; $i <= $current_page; $i++): ?>
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


<hr>            
<form class="well" method="post" action="<?php eh(url('comment/write')) ?>">
  <label>Your name</label>
  <input type="text" class="span2" name="username" value="<?php eh(Param::get('username')) ?>">
  
  <label>Comment</label>
  <textarea name="body"><?php eh(Param::get('body')) ?></textarea>
  <br />

  <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-medium btn-info">Submit</button>
</font> 
</form> 