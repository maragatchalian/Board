<font color = "black">
<h3>Bio</h3>

<?php if ($user->hasError()): ?>
    <div class="alert alert-error">
        <h4 class="alert-heading">Oh snap!</h4><h7>Change a few things up and try registering again.</h7><br /><br/>
 
 //Checking of username length 
if (!empty($user->validation_errors['bio']['length'])): ?>
    <div>
        <em>Your Username</em> must be between
        <?php eh($user->validation['bio']['length'][1]) ?> and
        <?php eh($user->validation['bio']['length'][2]) ?> characters.
    </div>
<?php endif ?>

<form class="form-horizontal">
<form action="<?php eh(url('')) ?>" method="POST">
<!--Username-->
    <div class="control-group">
    <label class="control-label" for="username"><h5>Bio:/h5></label>
    <div class="controls">
    <input type="text" name="bio" placeholder="Bio" value="<?php eh(Param::get('bio')) ?>">
    </div>
    </div>

     <div class="control-group">
    <div class="controls">
    <input type="hidden" name="page_next" value="edit_bio_end">
    <button class="btn btn-info btn-medium" type="submit"></span> Save</button>
    <br />
    <br />