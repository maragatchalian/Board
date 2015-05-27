<!--View thread and its comments --> 
<font color = "black">
<br />
<br />
<!--Thread Title-->
<center>
<h1><?php eh($thread->title) ?></h1>
<h3>Category: <?php eh($thread->category)?></h3>

<!-- Delete Thread -->
<?php if ($thread->checkThreadOwner()) : ?> 
  <a href="<?php eh(url('thread/delete', array('thread_id' => $thread->id)))?>"
  onclick="return confirm('Are you sure you want to delete this thread?')">
<span class ="icon-trash"></span>
</a> Delete This Thread<font color ="white">...</font>
<?php endif ?>
</br> 
</center>



<!--View Comments-->
<?php foreach($comments as $get_from_comment): ?>

<ul>
<!--Spacing-->
<div class ="comments">
<div class ="content">

<!--View Username-->
<h4> <a href="<?php eh(url('follow/others_profile', array('user_id' => $get_from_comment->user_id))) ?>">
  <?php eh($get_from_comment->username) ?> </h4> </a>

<!--View Comment Body-->    
<?php echo($get_from_comment->body) ?>
<br />

<!--View Date of Creation-->    
<em> posted <?php echo time_difference($get_from_comment->created) ?> </em>
<br /> 

<!-- Delete Comment -->
<?php if ($get_from_comment->isUserComment()) : ?> 
  <a href="<?php eh(url('comment/delete', array('comment_id' => $get_from_comment->id)))?>"
  onclick="return confirm('Are you sure you want to delete this comment?')">
<span class ="icon-trash"></span>
</a> Delete <font color ="white">...</font>
<?php endif ?>

 <!-- Favorite Comment -->
<?php if ($get_from_comment->getIsCommentFavorited($_SESSION['user_id'])): ?>
<a href="<?php eh(url('favorite/set_favorite', array('comment_id' => $get_from_comment->id, 'method' => 'add')))?>">
    <i class="icon-star"></i></a>
<?php else : ?>
<a href="<?php eh(url('favorite/set_favorite', array('comment_id' => $get_from_comment->id, 'method' => 'remove')))?>" class="yellow"> 
 <i class="icon-star icon-yellow"></i></a>
<?php endif ?>

<!-- Count Favorite -->
<?php echo $get_from_comment->countFavorite() ?> Favorites
<br />  
<br /> 
</ul>

<?php endforeach ?>

<?php if(empty($comments)): ?>
      This thread doesn't have any comments.
<?php endif ?>


<br />
<br />

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

<hr>            
<form class="well" method="post" action="<?php eh(url('comment/write')) ?>">
  <input type="hidden" class="span2" name="username" value="<?php eh($_SESSION['username']) ?>">
  
  <label>Comment</label>
  <textarea name="body"><?php eh(Param::get('body')) ?></textarea>
  <br />

  <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-medium btn-info">Submit</button>
</font> 
</form> 
</div> 
</div>

