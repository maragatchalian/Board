<br />
<font color ="black">
<h3>Edit Profile</h3>
</font>
    <?php if ($user->hasError()) : ?>
        <div class="alert alert-error">
        <h4 class="alert-heading">Oh snap!</h4>
            <h7>Change a few things up..</h7><br /><br/>
        
<?php if (!empty($user->validation_errors['username']['length'])): ?>
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
//First Name Validation 
    if (!empty($user->validation_errors['first_name']['length'])): ?>
    <div>
        <em>Your First Name</em> must be between
            <?php eh($user->validation['first_name']['length'][1]) ?> and
            <?php eh($user->validation['first_name']['length'][2]) ?> characters.
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
//Email Validation
    if (!empty($user->validation_errors['email']['length'])): ?>
        <div><em>Your Email</em> must be between
            <?php eh($user->validation['email']['length'][1]) ?> and
            <?php eh($user->validation['email']['length'][2]) ?> characters.
        </div>
<?php endif ?>

<?php
//Checking of email if it already exists 
    if(!empty($user->validation_errors['email']['exist'])): ?>
    <div>
         <em> Your email address</em> is already registered. Please choose another.
    </div>
<?php endif ?>
<?php endif ?>
</div>

<font color ="black">
<!--Username-->
<form action="<?php eh(url('')) ?>" method="post">
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

<input type="hidden" name="page_next" value="edit_end">
<div class="span12">
<br />
<button class="btn btn-info btn-medium" type="submit">Save</button>
<a href="<?php eh(url('user/profile')) ?>" class="btn btn-medium">Cancel</a>
</div>
</form>