<font color ='black'>
<br />
<br />
<h1>Category List</h1>
<ul>
    <?php foreach ($categories as $category): ?>
    	<li>
    		<a href="<?php readable_text('/thread/display_category?category='.$category) ?>">
    		<?php readable_text($category); ?></a>
    	</li>
    <?php endforeach; ?>

<?php if(empty($categories)): ?>
    No threads available.
<?php endif ?>
</font>
</ul>