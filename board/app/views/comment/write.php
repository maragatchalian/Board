<!--Write a new comment - Validation -->
<font color = "black">
<br />
<h2><?php readable_text($thread->title) ?></h2>

<?php if ($comment->hasError()): ?>
     <div class="alert alert-error">
     <h4 class="alert-heading">Oops!</h4>

<?php if (!empty($comment->validation_errors['body']['length'])): ?>                
   <div><em>Your Comment</em> must be between 
   <?php readable_text($comment->validation['body']['length'][1]) ?>  and                    
   <?php readable_text($comment->validation['body']['length'][2]) ?> characters.
   </div>            
<?php endif //End of Comment Validation?>

</div>                    
<?php endif ?>
            
<form class="well" method="post" action="<?php readable_text(url('comment/write')) ?>">
  <label>Comment</label>
  <textarea name="body"><?php readable_text(Param::get('body')) ?></textarea>
  <br />
  <input type="hidden" name="thread_id" value="<?php readable_texts($thread->id) ?>">
  <input type="hidden" name="page_next" value="write_end">
  <button type="submit" class="btn btn-medium btn-info">Submit</button>
                   
</form>
