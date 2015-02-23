<h1>All threads</h1>
       
<ul>
<?php foreach ($threads as $v): ?>
<li>
<a href="<?php eh(url('thread/view', array('thread_id' => $v->id))) ?>">
<?php eh($v->title) ?></a>        
</li>
<?php endforeach //Display contents of individual thread to href to A tag ?>

<!--Create button--> 
<br />
<br />
<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create')) ?>">Create</a>

</ul>
