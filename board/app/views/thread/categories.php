<font color ='black'>
<br />
<br />
<h1>Category List</h1>
<ul>
    <?php foreach ($categories as $category): ?>
    	<li>
    		<a href="<?php eh('/thread/display_category?category='.$category) ?>">
    		<?php eh($category); ?></a>
    	</li>
    <?php endforeach; ?>

<?php if(empty($categories)): ?>
    No threads available.
<?php endif ?>
</font>
</ul>