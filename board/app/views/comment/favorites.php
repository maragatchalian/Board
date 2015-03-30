<html>
    <head> </head>
        <font color ='black'>
        <center> 
            <br />
            <br />
        <h1> My Favorites </h1>
        <center>

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