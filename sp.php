<?php 
include 'config.inc.php';
include 'helpers.inc.php';
include 'db-classes.inc.php';

try{
    $con=DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS)); // making a connection string by sending it to the db-classes.inc.php.class 
    // this is to get the artist database connection
    $artistGateway = new ArtistDB($con);
    $artists= $artistGateway->getAll();
    // this is to get the genres database connection 
    $genreGateway = new GenresDB($con);
    $genres= $genreGateway->getAll();
}catch(Exception $e){
    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang=en>
<head>
        <meta charset="utf-8">
        <title>Search Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/theFile.css">
        <style>
        .center-form{
            display: flex;
            justify-content: center;
        }
        #sbutton{
            display: block;
            padding: 0.5em;
            font: 1rem;
            background-color: #266150;
            text-align: center;
            text-decoration: none;
            color: #f7eae3;
            border-radius: 5%;
            margin: auto;
            margin-bottom: 2em;
        }
        form p{
            padding: 1em;
            margin-bottom: 5em;
            margin-top: 2em;
            background-color: #266150;
            color: #f7eae3;
            text-align: center;
            font-size: x-large;
            letter-spacing: 2px;
            transform: scaleY(1.5);
        }
        select{
            margin: auto;
        }
</style>
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
                </ul>
            </nav>
        </header>
        <main class="container">
            <div class="spTitle"> Basic Song Search</div>
            <div class="center-form">
            <form action="bsrp.php" method="get">
                <p>
                <input type="radio" name="ButtonTest" value="title"> Title</input>
                    <input type="text" name="songTitleInput" size="60"/>
                </p>
                <p>
                <input type="radio" name="ButtonTest" value="artist"> Artist</input>
                    <select name="artistSelected" id="artistSelected">
                        <option value=0></option>
                            <?php
                                outputArtists($artists);
                            ?>
                    </select>
                </p>
                <!-- <input type="radio" name="ButtonTest" value= "year"> Year</input> -->
                <p>
                <label>Year</label>

                <!-- <label for="less">Less</label> -->
                <input type="radio" name="ButtonTest" value= "less" for="less"> Less</input>
                    <input type="number" id="less" name="yearLess" min="2017" max="2019">
                <input type="radio" name="ButtonTest" value= "greater" for="greater"> Greater</input>
                    <input type="number" id="greater" name="yearGreater" min="2016" max="2018">
                    <br>
                </p>

                <p>
                <input type="radio" name="ButtonTest" value="genre"> Genre</input>
                <!-- <?php 
                //echo "<input type='radio' name='genresSelectedB'>";
                ?> -->
                    <select name="genreSelected">
                        <option value=0></option>
                        <?php
                            outputGenres($genres);
                        ?>
                    </select>
                </p>
                <p>
                <label>Popularity</label>
                <input type="radio" name="ButtonTest" value="Less"> Less</input>
                    <input type="number" id="less2" name="popLess" min="0" max="100">
                <input type="radio" name="ButtonTest" value="Greater" for="greater"> Greater</input>
                    <input type="number" id="greater" name="popGreater" min="1" max="100">
                </p>
                    <br>
                    <div class="searchButton">
                    <input type="submit" value="Search" id="sbutton">
                    </div>
            </form>
            </div>
        </main>
        <footer>
        <p>COMP 3512 - </p><a href='https://github.com/jillianbennett24/asg1.git'> GitHub link </a> <p> - Created by Jillian Bennett. © 2022</p>
        </footer>
    </body>
</html>