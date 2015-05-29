<!--End of Thread Creation --> 
<font color = "black">
	<br />
	<br />
<h2><?php readable_text($thread->title) ?></h2>         
    <p class="alert alert-success">
        You've successfully created a thread.                
    </p>
                        
<a href="<?php readable_text(url('thread/view', array('thread_id' => $thread->id))) ?>">
    &larr; Go to threads   
</font>                 
</a>
