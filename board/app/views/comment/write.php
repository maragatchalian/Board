<!--Write a new comment - Validation -->
<font color = "black">
<br />
<h2><?php eh($thread->title) ?></h2>

<?php if ($comment->hasError()): ?>
     <div class="alert alert-error">
     <h4 class="alert-heading">Oops!</h4>

<?php if (!empty($comment->validation_errors['body']['length'])): ?>                
   <div><em>Your Comment</em> must be between 
   <?php eh($comment->validation['body']['length'][1]) ?>  and                    
   <?php eh($comment->validation['body']['length'][2]) ?> characters.
   </div>            
<?php endif //End of Comment Validation?>

</div>                    
<?php endif ?>
            
<form class="well" method="post" action="<?php eh(url('comment/write')) ?>">
  <label>Comment</label>
  <textarea name="body"><?php eh(Param::get('body')) ?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?php eh($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-medium btn-info">Submit</button>
                   
</form>
