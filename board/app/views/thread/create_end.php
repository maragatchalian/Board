<!--End of Thread Creation --> 
<font color = "black">
	<br />
	<br />
<h2><?php eh($thread->title) ?></h2>         
    <p class="alert alert-success">
        You've successfully created a thread.                
    </p>
                        
<a href="<?php eh(url('thread/view', array('thread_id' => $thread->id))) ?>">
    &larr; Go to threads   
</font>                 
</a>
