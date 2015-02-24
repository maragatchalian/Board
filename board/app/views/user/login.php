<h1>Welcome!</h1>
<h5>Please log in to continue</h5>
<br />

<?php if ($user->hasError()): ?>
	<div class="alert alert-block">
	<h4 class="alert-heading">Validation error!</h4>

<?php 
////Verify User Account
if (!empty($user->validation_errors['password']['correct'])): ?>
	<div>
	<em>Invalid Username or Password</em>
	</div>
<?php endif  ?>

</div>
<?php endif ?>

<form action="<?php eh(url('')) ?>" method="post">
	<div class="span12">
	<label for="username"><h4>Username</h4></label>
	<input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
	</div>

	<div class="span12">
	<label for="password"><h4>Password</h4></label>
	<input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
	</div>
	<br />

	<input type="hidden" name="page_next" value="home">
	<div class="span12">
	<button class="btn btn-info btn-large" type="submit">Login</button>

	<br />
	<br /> 
If you don't have an account, register 
<a href="<?php eh(url('user/register')) ?>"> HERE</a>.
</div>

</form>