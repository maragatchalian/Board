<font color = "black">
<h1> Hello!</h1>
<h4> それはあなたを見て良いことだ~</h4>
<h5>Please log in to continue</h5>
<br />

<!--Empty/invalid username/password error message-->
<?php if (!is_logged_in() && $user->username != '') : ?> 
    <div class="alert alert-error">
        <em><h4 class="alert-heading">Oops!</h4></em>
        <em>Invalid Username or Password</em>
    </div>
<?php endif  ?>

    <form class="form-horizontal">
    <form action="<?php readable_text(url('')) ?>" method="post">
    <div class="control-group">
    <label class="control-label" for ="username"><h4>Username</h4></label>
    <div class="controls">
    <input type="text" placeholder = "Username" name="username" value="<?php readable_text(Param::get('username')) ?>">
    </div>
    </div>
 
    <div class="control-group">
    <label class="control-label" for="password"><h4>Password</h4></label>
    <div class="controls">
    <input type="password" placeholder = "Password" name="password" value="<?php readable_text(Param::get('password')) ?>">
    </div>
    </div>
    <br />
 
<!--Will be redirected to login_end once successfully logged in-->
    <div class="control-group">
    <div class="controls">
    <input type="hidden" name="page_next" value="home">
    <div class="span12">
    <button class="btn btn-info btn-medium" type="submit">Login</button>

    <br />
    <br /> 

If you don't have an account, register 
<a href="<?php readable_text(url('user/register')) ?>"> HERE</a>.
</div>
</div>
</div>

</form>
</font>

