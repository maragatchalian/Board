<html>
    <head> </head>
		<font color ='black'>
		<center> 
		<h1> My Favorites </h1>
        <br />
        <br />
        <center>
                Hello, <?php eh($user->username) ?>!
                <br /> 
               
               <?php foreach($comments as $get_from_comment): ?>
               You have <?php echo $get_from_comment->countFavorite() ?> Favorites             
			   <?php endforeach ?>
               
                
                </font>
        </center>
        </form>
    </body>
</html>
