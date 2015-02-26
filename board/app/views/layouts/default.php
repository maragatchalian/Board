<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Board </title>

<!-- Bootstrap Core CSS -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!--The Links (Once user is logged in)-->
<div class="container">
<?php if (isset($_SESSION['user_id'])):?>
	<nav class="navbar navbar-default">
	 	<div class="container-fluid">
	 		
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
				<a class="brand"> Welcome to DietCake</a>
			</div>
		</div>
	</div>


<!--The Links (Once user is logged in) trial-->
<div class="container">
<?php if (isset($_SESSION['user_id'])):?>
	<div class="container-fluid">-->
		<style>
			ul#menu {
    		padding: 0;
    		text-align: center;
			}

	ul#menu li {
   	 display: inline;
   	 }

	ul#menu li a {
 		background-color: black;
   		color: white;
    	padding: 5px 5px;
    	text-decoration: none;
    	border-radius: 2px 2px 0 0;
    	text-align: center;
	}

	ul#menu li a:hover {
    	background-color: lightgrey;
    	color: black;
    }

</style>
	<ul id="menu">
		<li><a href="<?php eh(url('user/home')) ?>">Home</a>
		<li><a href="<?php eh(url('thread/index')) ?>">All Threads</a></li>
 		<li><a href="<?php eh(url('thread/create')) ?>">Create New Thread</a></li>	
 		<li><a href="<?php eh(url('user/logout')) ?>">Logout</a></li>
	</ul>  
 <?php endif ?>


 <?php endif ?>

	 		 	  
	<?php echo $_content_ ?>
	</div>


	<script>
	console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
	</script>

	</body>
</html>