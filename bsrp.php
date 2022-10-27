<?php
require_once 'config.inc.php';
require_once 'helpers.inc.php';
require_once 'db-classes.inc.php';

try{
    $con=DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS)); // making a connection string by sending it to the db-classes.inc.php.class 
    $songGateway=new SongsDB($con);

    if (isset($_GET['ButtonTest'])){
        $option= $_GET['ButtonTest'];
        if ($option == "title"){
            if(isset($_GET['songTitleInput'])){
                $song=$songGateway->getAllForTitleInput($_GET['songTitleInput']);
            }else{
                echo "You didnt put a value in the input:(";
            }
        }
        if ($option =="artist"){
            if(isset($_GET['artistSelected'])){
                    $song=$songGateway->getAllForArtist($_GET['artistSelected']);
                    // outputSongs($song);
                }else{
                    echo "You didnt put a value in the input:(";
                }
        }
        if ($option == "genre"){
            if (isset($_GET['genreSelected']) ){
                $song=$songGateway->getAllForGenres($_GET['genreSelected']);
            } else{
                echo "You didnt put a value in the input:(";
            }
        }
        if($option == "less"){
            if ( isset($_GET['yearLess'])){
                $song=$songGateway->getAllForYearLess($_GET['yearLess']);
            }else{
                echo "You didnt put a value in the input:(";
            }
        }
        if($option == "greater"){
            if ( isset($_GET['yearGreater'])){
                $song=$songGateway->getAllForYearMore($_GET['yearGreater']);
            }
            else{
                echo "You didnt put a value in the input:(";
            }
        }
        if($option == "Less"){
            if ( isset($_GET['popLess'])){
                $song=$songGateway->getAllForPopLess($_GET['popLess']);
            }
            else{
                echo "You didnt put a value in the input:(";
            }
        }
        if($option == "Greater"){
            if ( isset($_GET['popGreater'])){
                $song=$songGateway->getAllForPopMore($_GET['popGreater']);
            }
            else{
                echo "You didnt put a value in the input:(";
            }
        }
    }
    else{
        $song = null;
    }
}catch (Exception $e){
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="utf-8">
        <title>Browse And Search Results</title>
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
                    <li><a href='homePage.php'>home</a></li>
                    <li><a href='fav.php'>Favorites</a></li>
                    <li><a href='bsrp.php?'>Browse</a></li>
                    <li><a href='sp.php'>Search</a></li>
                </ul>
            </nav>
        </header>
        <main class="container">
            <div class="spTitle"> Browse/Search Results</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Year</th>
                        <th>Genre</th>
                        <th>Popularity</th>
                        <th>  </th>
                        <th>  </th>
                    </tr>
                </thead>
                <tbody>
                    
                       <?php outputSongsInRow($song);?>
                    
                </tbody>
            </table>
        </main>
        <footer>
        <p>COMP 3512 - </p><a href='https://github.com/jillianbennett24/asg1.git'> GitHub link </a> <p> - Created by Jillian Bennett. © 2022</p>
        </footer>
    </body>
</html>