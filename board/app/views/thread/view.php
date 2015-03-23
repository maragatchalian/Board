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
  <a href="<?php eh(url('comment/delete', array('comment_id' => $get_from_comment->id)))?>"
  onclick="return confirm('Are you sure you want to delete this comment?')">
|| Delete this comment ||
</a>
<?php endif ?>

 <!-- Favorite Comment -->
<?php if ($get_from_comment->isCommentFavorited()) : ?>
<a href="<?php eh(url('comment/setFavorite', array('comment_id' => $get_from_comment->id, 'method' => 'add')))?>">
    Favorite</a>
<?php else : ?>
<a href="<?php eh(url('comment/setFavorite', array('comment_id' => $get_from_comment->id, 'method' => 'remove')))?>">
  Unfavorite</a>
<?php endif ?>

<!-- Count Favorite -->
<?php echo $get_from_comment->countFavorite() ?> Favorites

<?php endforeach ?>

 <!-- Follow/Unfollow User -->
<?php if ($users->isUserFollow()) : ?> 
<a href="<?php eh(url('user/setFollowing', array('user_id' => $users->id, 'method' => 'add')))?>">
    Follow</a>
<?php else : ?>
<a href="<?php eh(url('user/setFollowing', array('user_id' => $users->id, 'method' => 'remove')))?>">
  Unfollow</a>
<?php endif ?>

</div> 
</div>

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