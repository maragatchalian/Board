<!DOCTYPE html>
<html>
    <head> <meta charset="utf-8"> </head>
        <title> Welcome to FoodFacts</title>

<!-- Bootstrap Core CSS -->
<link href="/bootstrap/css/custom.css" rel="stylesheet">
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/bootstrap/css/glyphicons-extended.min.css" rel="stylesheet">
<link href="/bootstrap/css/custom.css" rel="stylesheet">

<!--Dietcake Heading -->
<body>
                            
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php eh(url('comment/home')) ?>"> <font color ="white"> FoodFacts! </font></a>                   
        </div>
    </div>
</div>

<!--Menu Bar (Once the user is logged in)-->
<style>
    body{
        padding-top: 60px;
        }
</style>

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
        <li><a href="<?php eh(url('comment/home')) ?>">Home</a>
        <li><a href="<?php eh(url('user/profile')) ?>">Profile</a></li>
        <li><a href="<?php eh(url('thread/index')) ?>">All Threads</a></li>
        <li><a href="<?php eh(url('thread/own_threads')) ?>">My Threads</a></li>
        <li><a href="<?php eh(url('thread/by_category')) ?>">Thread Categories</a></li>
        <li><a href="<?php eh(url('thread/create')) ?>">Create New Thread</a></li>  
        <li><a href="<?php eh(url('follow/get_all_users')) ?>">Users</a></li> 
        <li><a href="<?php eh(url('user/logout')) ?>">Logout</a></li>
        </ul>    
<?php endif ?>
               
<?php echo $_content_ ?>
</div>

<script>
    console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
</script>

</body>
</html>