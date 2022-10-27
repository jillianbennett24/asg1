<?php
include 'config.inc.php';
include 'helpers.inc.php';
include 'db-classes.inc.php';


try{
    $con=DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS)); // making a connection string by sending it to the db-classes.inc.php.class 
    $genresGateway = new GenresDB($con);
    $topgenres=$genresGateway->getTopGenres();

    $artistGateway = new ArtistDB($con);
    $topartists=$artistGateway->getTopArtists();

    $songGateway= new SongsDB($con);
    $topPopSongs=$songGateway->getTopPop();

    $oneHitWonders=$songGateway->getOneHitWonders();
    $acousicness=$songGateway->getacousticness();
    $club=$songGateway->getAtClub();
    $running = $songGateway->getRunningSongs();
    $studying=$songGateway->getStudySongs();
    
}catch(Exception $e){
    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/theFile.css">
    <link rel="stylesheet" href="./css/homePageStyles.css">
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
        <div class="spTitle">Home</div>
        <div class="home-grid">
            <div class="box">
                <h2>Top Genres</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Genre</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php outputTopGenres($topgenres); ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>Top Artists</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Artist</th>
                            <th>Number of Songs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php outputTopArtist($topartists); ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>Most Popular Songs</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Songs</th>
                            <th>Artist</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php outputTopPop($topPopSongs); ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>One Hit Wonders</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Song</th>
                            <th>Artist</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php outputOneHit($oneHitWonders); ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>Longest Acoustic Songs</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Song</th>
                            <th>Artist</th>
                            <th>Acoustic Score</th>
                            <th>Duraration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php acousticnessOutput($acousicness); ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>At the Club</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Song</th>
                            <th>Artist</th>
                            <th>Clubbing Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            outputAtClub($club);
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>Running Songs</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Song</th>
                            <th>Artist</th>
                            <th>Running Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php outputRunning($running); ?>
                    </tbody>
                </table>
            </div>
            <div class="box">
            <h2>Studying</h2>
                <!-- Note you said because its the same php logic when generating a table as a unordered list its allowed  -->
                <table>
                    <thead>
                        <tr>
                            <th>Song</th>
                            <th>Artist</th>
                            <th>Studying Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php outputStudying($studying); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
    <footer>
    <p>COMP 3512 - </p><a href='https://github.com/jillianbennett24/asg1.git'> GitHub link </a> <p> - Created by Jillian Bennett. © 2022</p>
    </footer>
</body>

</html>

