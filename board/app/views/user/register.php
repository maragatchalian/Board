<font color = "black">
<h3>Registration</h3>
<h5>Please fill up this form:</h5>

<?php if ($user->hasError()): ?>
    <div class="alert alert-error">
        <h4 class="alert-heading">Oh snap!</h4><h7>Change a few things up and try registering again.</h7><br /><br/>
 
<?php 
//Checking of username if it's valid
    if ($user->validation_errors['username']['valid']): ?>
    <div>
        <em>Username may only consist of letters, numbers,  hypen (-), underscores(_), and dots(.).</em>
    </div>
<?php endif ?>

<?php 
//Checking of username length 
if (!empty($user->validation_errors['username']['length'])): ?>
    <div>
        <em>Your Username</em> must be between
        <?php eh($user->validation['username']['length'][1]) ?> and
        <?php eh($user->validation['username']['length'][2]) ?> characters.
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
//Checking of first_name length
if (!empty($user->validation_errors['first_name']['length'])): ?>
    <div>
        <em>Your First Name</em> must be between
            <?php eh($user->validation['first_name']['length'][1]) ?> and
            <?php eh($user->validation['first_name']['length'][2]) ?> characters.
    </div>
<?php endif ?>

<?php 
//Checking of first_name if it's valid.
    if ($user->validation_errors['first_name']['valid']): ?>
    <div>
        <em>First Name </em> MUST only consist of letters or hypen (-)</em>
    </div>
<?php endif ?>

<?php 
//Last Name Validation
    if (!empty($user->validation_errors['last_name']['length'])): ?>
    <div><em>Your Last Name</em> must be between
        <?php eh($user->validation['last_name']['length'][1]) ?> and
        <?php eh($user->validation['last_name']['length'][2]) ?> characters.
    </div>
<?php endif ?>

<?php
//Checking of first_name if it's valid.
if ($user->validation_errors['last_name']['valid']): ?>
    <div>
        <em>Last Name </em> MUST only consist of letters or hypen (-)</em>
    </div>
<?php endif ?>


<?php 
//Email Validation
if (!empty($user->validation_errors['email']['length'])): ?>
    <div><em>Your Email</em> must be 
        <?php eh($user->validation['email']['length'][1]) ?> 
        <?php eh($user->validation['email']['length'][2]) ?> characters and below only.
    </div>
<?php endif ?>

<?php
//Checking of email if it already exists 
if(!empty($user->validation_errors['email']['exist'])): ?>
    <div>
         <em> Your email address</em> is already registered. Please choose another.
    </div>
<?php endif ?>

<?php 
//Password Validation
if (!empty($user->validation_errors['password']['length'])): ?>
    <div><em>Your Password</em> must be between
        <?php eh($user->validation['password']['length'][1]) ?> and
        <?php eh($user->validation['password']['length'][2]) ?> characters.
    </div>
<?php endif ?>

<?php 
//Checking if Password and Confirm Password matched
if (!empty($user->validation_errors['confirm_password']['match'])) : ?> 
    <div>
        <em>Passwords</em> did not match!
    </div>
<?php endif ?>

</div>
<?php endif ?> 

<form class="form-horizontal">
<form action="<?php eh(url('')) ?>" method="POST">
<!--Username-->
    <div class="control-group">
    <label class="control-label" for="username"><h5>Username</h5></label>
    <div class="controls">
    <input type="text" name="username" placeholder="Username" value="<?php eh(Param::get('username')) ?>">
    </div>
    </div>

<!--First Name-->
    <div class="control-group">
    <label class="control-label" for="first_name"><h5>First Name</h5></label>
    <div class="controls">
    <input type="text" name="first_name" placeholder="First Name" value="<?php eh(Param::get('first_name')) ?>">
    </div>
    </div>

<!--Last Name-->
    <div class="control-group">
    <label class="control-label" for="last_name"><h5>Last Name</h5></label>
    <div class="controls">
    <input type="text" name="last_name" placeholder="Last Name" value="<?php eh(Param::get('last_name')) ?>">
    </div>
    </div>

<!--Email-->
    <div class="control-group">
    <label class="control-label" for="email"><h5>Email</h5></label>
    <div class="controls">
    <input type="email" name="email" placeholder="Email" value="<?php eh(Param::get('email')) ?>">
    </div>
    </div>

<!--Password -->
    <div class="control-group">
    <label class="control-label" for="password"><h5>Password</h5></label>
    <div class="controls">
    <input type="password" name="password" placeholder="Password" value="<?php eh(Param::get('password')) ?>">
    </div>
    </div>

<!--Confirm Password-->
    <div class="control-group">
    <label class="control-label" for="confirm_password"><h5>Confirm Password</h5></label>
    <div class="controls">
    <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php eh(Param::get('confirm_password')) ?>">
    </div>
    </div>

    <div class="control-group">
    <div class="controls">
    <input type="hidden" name="page_next" value="register_end">
    <button class="btn btn-info btn-medium" type="submit"></span> Register</button>
    <br />
    <br />

<!--If user already has an account-->
    Already have an account? Log in
    <a href="<?php eh(url('user/login')) ?>"> HERE</a>.
    </div>
    </div>
</form>
</font>