<font color = "black">
<h3>Edit Password</h3>

<?php if ($user->hasError()): ?>
    <div class="alert alert-error">
        <h4 class="alert-heading">Oh snap!</h4><h7>Change a few things up and try registering again.</h7><br /><br/>
 
<?php 
//Password Validation
if (empty($user->validation_errors['password']['length'])): ?>
    <div><em>Your Password</em> must be between
        <?php eh($user->validation['password']['length'][1]) ?> and
        <?php eh($user->validation['password']['length'][2]) ?> characters.
    </div>
<?php endif ?>

<?php 
//Checking if Password and Confirm Password matched
if (empty($user->validation_errors['confirm_password']['match'])) : ?> 
    <div>
        <em>Passwords</em> did not match!
    </div>
<?php endif ?>

</div>
<?php endif ?> 

<form class="form-horizontal">
<form action="<?php eh(url('')) ?>" method="POST">
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
    <input type="hidden" name="page_next" value="edit_password_end">
    <button class="btn btn-info btn-medium" type="submit"></span> Save</button>
    <a href="<?php eh(url('user/profile')) ?>" class="btn btn-medium">Cancel</a>
    <br />
    <br />

    </div>
    </div>
</form>
</font>