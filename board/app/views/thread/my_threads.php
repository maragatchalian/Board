<font color ='black'>
<br />
<br />
<h1>My Threads</h1>

<ul style="list-style-type:square">
    <?php foreach ($threads as $thread): ?>
    <li>
    <a href="<?php eh(url('thread/view', array('thread_id' => $thread->id))) ?>">
    <?php eh($thread->title) ?></a>        
    </li>

    <?php endforeach; //Display contents of individual thread to href to A tag ?>

<!--Create button--> 
<br />
<br />
<a class="btn btn-medium btn-info" href="<?php eh(url('thread/create')) ?>">Create Thread</a>

</font>
<ul>


