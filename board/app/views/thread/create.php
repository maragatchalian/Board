<!--View for Creation of comments on thread --> 
<font color = "black">
    <br />
    <br />
<h1> Create a thread</h1>
              
<?php if ($thread->hasError() || $comment->hasError()): ?>
  <div class="alert alert-error">             
  <h4 class="alert-heading">Oops!</h4>

  <!--Category  Validation Error Message--> 
  <?php if (!empty($thread->validation_errors['category']['length'])): ?>    
    <div>
     Please select a <em>Category</em> 
    </div>
  <?php endif ?>

  <!--Title Validation Error Message--> 
  <?php if (!empty($thread->validation_errors['title']['length'])): ?>    
    <div>
    <em>Title</em> 
      must be between
      <?php readable_text($thread->validation['title']['length'][1]) ?> and
      <?php readable_text($thread->validation['title']['length'][2]) ?> characters.
    </div>
  <?php endif ?>

  <!--Comment Validation Error Message--> 
  <?php if (!empty($comment->validation_errors['body']['length'])): ?>
    <div>
      <em>Comment</em> 
        must be between
        <?php readable_text($comment->validation['body']['length'][1]) ?> and
        <?php readable_text($comment->validation['body']['length'][2]) ?> characters.
    </div>
  <?php endif ?>

</div>
<?php endif ?>
 
<form class="well" method="post" action="<?php readable_text(url('')) ?>">
 
<label>Category</label>
    <select name="category">
        <option value="">Please Select</option>
        <option value="Food">Food</option>
        <option value="Beverages">Beverages</option>
        <option value="Desserts">Desserts</option>
        <option value="Location">Location</option>
        <option value="Restaurants">Restaurants</option>
    </select>

<br />
<br />

<label>Title</label>
<input type="text" class="span2" name="title" value="<?php readable_text(Param::get('title')) ?>">
<input type="hidden" class="span2" name="username" value="<?php readable_text($_SESSION['username']) ?>">
  
 
<label>Comment</label>
  <textarea name="body"><?php readable_text(Param::get('body')) ?></textarea>

<br />

<input type="hidden" name="page_next" value="create_end">
<button type="submit" class="btn brt-medium btn-info">Submit</button>                

</font>
</form>