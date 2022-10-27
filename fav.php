<?php
// require_once 'config.inc.php';
 //require_once 'helpers.inc.php';
// require_once 'db-classes.inc.php';

include 'config.inc.php';
include 'helpers.inc.php';
include 'db-classes.inc.php';

session_start();

//initialize empty array if they dont have sny 
if( !isset($_SESSION['Favorites'])){
    $_SESSION["Favorites"] = []; 
}

// retrieve favorites array for this user session
$favorites = $_SESSION["Favorites"];
 
$con=DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS)); // making a connection string by sending it to the db-classes.inc.php.class 
$songGateway=new SongsDB($con);
   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Favorites page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/theFile.css">
    </head>
    <body>
        <header>
            <div class="headerTitle">
                <ul>
                    <li><h1>3512 Assign 1</h1></li>
                    <li><h2>Jillian Bennett</h2></li>
                </ul>
                
            </div>
            <nav>
                <ul class="nav_list">
                    <li><a href='homePage.php'>Home</a></li>
                    <li><a href='fav.php'>Favorites</a></li>
                    <li><a href='bsrp.php?'>Browse</a></li>
                    <li><a href='sp.php'>Search</a></li>
                    <!-- <li><a href=“browse.html”>Browse</a></li> -->
                </ul>
            </nav>
        </header>
        <main class="container">
        <div class="spTitle"> Favorites</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Year</th>
                        <th>Genre</th>
                        <th>Popularity</th>
                        <th>   </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //echo json_encode($favorites);
                       for( $i=0;$i<count($favorites);$i++){
                            $testsong = $songGateway->getSongWSongId($favorites[$i]);
                            $song_id = $testsong[0]['song_id'];
                            outputSongInRowFav($testsong);
                             } 
                    ?>
                </tbody>
            </table>
            <!-- <div class="connecter"> -->
            <a  href="emptyFavorites.php" class="connecter_empty">
				Empty Favorites
            </a>
         
            <!-- <a  href="emptyFavorites.php">
				Empty Favorites
            </a> -->
        </main>
        <footer>
            this is the footer! 
        </footer>
    </body>
</html>
