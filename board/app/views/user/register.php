<h3>Registration</h3>
<h5>Please fill up this form:</h5>

<?php if ($user->hasError()): ?>
	<div class="alert alert-block">
		
<?php
//Username Validation
	 print_r($user->validation_errors); ?>
	<em><h4 class="alert-heading">Oops!</h4></em>

<?php if (!empty($user->validation_errors['username']['length'])): ?>
	<div>
		<em>Your Username</em> must be between
		<?php eh($user->validation['username']['length'][1]) ?> and
		<?php eh($user->validation['username']['length'][2]) ?> characters in length.
	</div>
<?php endif ?>



<?php 
//Checking of username if it exists
	if (!empty($user->validation_errors['username']['exist'])): ?>
	<div>
		<em> Username is already taken. Please choose another.</em>
	</div>
<?php endif ?>


<?php
//Checking of email if it already exists
	if(!empty($user->validation_errors['email']['exist'])): ?>
	<div>
		<em> The email address is already registered. Please choose another.</em>
	</div>
<?php endif ?>

<?php 
//First Name Validation 
	if (!empty($user->validation_errors['first_name']['length'])): ?>
	<div>
		<em>Your First Name</em> must be between
			<?php eh($user->validation['first_name']['length'][1]) ?> and
			<?php eh($user->validation['first_name']['length'][2]) ?> characters in length.
	</div>
<?php endif ?>


<?php 
//Last Name Validation
	if (!empty($user->validation_errors['last_name']['length'])): ?>
	<div><em>Your Last Name</em> must be between
		<?php eh($user->validation['last_name']['length'][1]) ?> and
		<?php eh($user->validation['last_name']['length'][2]) ?> characters in length.
	</div>
<?php endif ?>

<?php 
//Email Validation
	if (!empty($user->validation_errors['email']['length'])): ?>
		<div><em>Your Email</em> must be between
			<?php eh($user->validation['email']['length'][1]) ?> and
			<?php eh($user->validation['email']['length'][2]) ?> characters in length.
		</div>
<?php endif ?>

<?php 
//Password Validation
	if (!empty($user->validation_errors['password']['length'])): ?>
		<div><em>Your Password</em> must be between
			<?php eh($user->validation['password']['length'][1]) ?> and
			<?php eh($user->validation['password']['length'][2]) ?> characters in length.
		</div>
<?php endif ?>

<?php 

//Checking if Password and Confirm Password matched
	if (!empty($user->validation_errors['confirm_password']['match'])): ?>
	<div>
		Passwords did not match!
		</div>
<?php endif ?>

</div>
<?php endif ?> 


<form action="<?php eh(url('')) ?>" method="post">
<!--Username-->
	<div class="span12">
	<label for="username"><h5>Username</h5></label>
	<input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
</div>

<!--First Name-->
	<div class="span12">
	<label for="first_name"><h5>First Name</h5></label>
	<input type="text" name="first_name" value="<?php eh(Param::get('first_name')) ?>">
	</div>

<!--Last Name-->
	<div class="span12">
	<label for="last_name"><h5>Last Name</h5></label>
	<input type="text" name="last_name" value="<?php eh(Param::get('last_name')) ?>">
	</div>

<!--Email-->
	<div class="span12">
	<label for="email"><h5>Email</h5></label>
	<input type="email" name="email" value="<?php eh(Param::get('email')) ?>">
	</div>

<!--Password -->
	<div class="span12">
	<label for="password"><h5>Password</h5></label>
	<input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
	</div>
	<br />

<!--Confirm Password-->
	<div class="span12">
	<label for="confirm_password"><h5>Confirm Password</h5></label>
	<input type="password" name="confirm_password" value="<?php eh(Param::get('confirm_password')) ?>">
	</div>

<input type="hidden" name="page_next" value="register_end">
<div class="span12">
<button class="btn btn-info btn-medium" type="submit">Register</button>
<br />
<br />

<!--If user already has an account-->
Already have an account? Log in
	<a href="<?php eh(url('user/login')) ?>"> HERE</a>.

</div>
</form>