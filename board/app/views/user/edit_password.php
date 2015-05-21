<br />
<font color ="black">
<h3>Edit Password</h3>
</font>
    <?php if ($user->hasError()) : ?>
        <div class="alert alert-error">
        <h4 class="alert-heading">Oh snap!</h4>
            <h7>Change a few things up..</h7><br /><br/>
        
<?php if (empty($user->validation_errors['password']['length'])): ?>
    <div>
        <em>Your Password</em> must be between
        <?php eh($user->validation['password']['length'][1]) ?> and
        <?php eh($user->validation['password']['length'][2]) ?> characters.
    </div>
<?php endif ?>

<?php 
//Checking of username if it exists
if (empty($user->validation_errors['confirm_password']['match'])): ?>
    <div>
        <em> Passwords did not match!</em>
    </div>
<?php endif ?>

</div>
<?php endif ?>

<font color ="black">
<br />
<form action="<?php eh(url('')) ?>" method="post">

    <!--Confirm Password-->
    <div class="control-group">
    <label class="control-label" for="confirm_password"><h5>Confirm Password</h5></label>
    <div class="controls">
    <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php eh(Param::get('confirm_password')) ?>">
    </div>
    </div>

<!--Password -->
    <div class="control-group">
    <label class="control-label" for="password"><h5>Password</h5></label>
    <div class="controls">
    <input type="password" name="password" placeholder="Password" value="<?php eh(Param::get('password')) ?>">
    </div>
    </div>

    <div class="control-group">
    <div class="controls">
    <input type="hidden" name="page_next" value="edit_password_end">
    <button class="btn btn-info btn-medium" type="submit"></span> Save</button>
    <a href="<?php eh(url('user/profile')) ?>" class="btn btn-medium">Cancel</a>
    <br />
    <br />
</form>