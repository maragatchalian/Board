<br />
<font color ="black">
<h3>Edit Password</h3>
    
    <?php if ($user->hasError()) : ?>
        <div class="alert alert-error">
        <h4 class="alert-heading">Oh snap!</h4>
            <h7>Change a few things up..</h7><br /><br/>
 
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

<!--Password -->
<div class="span12">
<label for="password"><h5>New Password</h5></label>
<input type="password" name="password" placeholder="Password" value="<?php eh(Param::get('password')) ?>">
</div>
<!--Confirm Password-->
<div class="span12">
<label for="confirm_password"><h5>Confirm New Password</h5></label>
<input type="password" placeholder="Confirm Password" value="<?php eh(Param::get('confirm_password')) ?>">
</div>

<input type="hidden" name="page_next" value="edit_password_end">
<div class="span12">
<br />
<button class="btn btn-info btn-medium" type="submit">Save</button>
<a href="<?php eh(url('user/profile')) ?>" class="btn btn-medium">Cancel</a>
</div>
</div>
