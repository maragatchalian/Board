<!DOCTYPE html>
<html>
<head> <meta charset="utf-8">
<title> DietCake Board </title>

<!-- Bootstrap Core CSS -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<style>
    body{
        padding-top: 60px;
        }
</style>

<!--Dietcake Heading -->
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
     <a class="brand"> FoodFacts!</a>
            </div>
        </div>
    </div>

<!--Menu Bar (Once the user is logged in)-->
<div class="container">
<?php if (isset($_SESSION['user_id'])):?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    
    <style>
        ul#menu 
        {
        padding: 0;
        text-align: center;
        }

        ul#menu li 
        {
        display: inline;
        }

        ul#menu li a 
        {
        background-color: black;
        color: white;
        padding: 5px 5px;
        text-decoration: none;
        border-radius: 2px 2px 0 0;
        text-align: center;
        }

        ul#menu li a:hover 
        {
        color: black;
        background-color: lightgrey;
        }
    </style>

    <ul id="menu">
        <li><a href="<?php eh(url('user/home')) ?>">Home</a>
        <li><a href="<?php eh(url('user/profile')) ?>">Profile</a></li>
        <li><a href="<?php eh(url('thread/index')) ?>">Threads</a>
        <li><a href="<?php eh(url('thread/create')) ?>">Create New Thread</a></li>  
        <li><a href="<?php eh(url('#')) ?>">Users</a></li> 
        <li><a href="<?php eh(url('user/logout')) ?>">Logout</a></li>
    </ul>  
    <br />

    
      
<?php endif ?>
               
<?php echo $_content_ ?>
</div>

<script>
    console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
</script>

</body>
</html>