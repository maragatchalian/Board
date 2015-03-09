<font color = "black">
<h1> Hello!</h1>
<h4> それはあなたを見て良いことだ~</h4>
<h5>Please log in to continue</h5>
<br />

<!--Empty/invalid username/password error message-->
<?php if (!$user->is_validated) : ?>
    <div class="alert alert-error">
        <em><h4 class="alert-heading">Oops!</h4></em>
        <em>Invalid Username or Password</em>
    </div>
<?php endif  ?>


<form action="<?php eh(url('')) ?>" method="post">
    <div class="span12">
    <label for="username"><h4>Username:</h4></label>
    <input type="text" name="username" value="<?php eh(Param::get('username')) ?>">
    </div>

    <div class="span12">
    <label for="password"><h4>Password:</h4></label>
    <input type="password" name="password" value="<?php eh(Param::get('password')) ?>">
    </div>
    <br />
    
<!--Will be redirected to login_end once successfully logged in-->
    <input type="hidden" name="page_next" value="login_end">
    <div class="span12">
    <button class="btn btn-info btn-medium" type="submit">Login</button>

    <br />
    <br /> 
If you don't have an account, register 
<a href="<?php eh(url('user/register')) ?>"> HERE</a>.
</div>

</form>
</font>