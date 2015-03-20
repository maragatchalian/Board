<html>
    <head> </head>
        <font color ='black'>
        <center> 
        <h1> My Favorites </h1>
        <br />
        <br />
        <center>
                <h3>Hello, <?php eh($user->first_name) ?>! </h3>
                <br /> 
                Here's the list of your favorite comments:
                    <br /> 
                            
            <ul style="list-style-type:square">
            <?php foreach ($favorites as $get_from_favorite): ?>
            <li>
                <?php eh($get_from_favorite->comment_body) ?></a>      
                   
            </li>
                <?php endforeach; //Display contents of individual thread to href to A tag ?>
           
                </font>
        </center>
        </form>
    </body>
</html>
