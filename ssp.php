<?php
include 'config.inc.php';
include 'helpers.inc.php';
include 'db-classes.inc.php';

try {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS)); 
   
      $songGateway = new SongsDB($conn);

      $testsong = $songGateway->getSongWSongId($_GET['song_id']);

      $artistType= $songGateway->getArtistType($_GET['song_id']);
    
      $artist= $testsong[0]['artist_name'];
      $title= $testsong[0]['title'];
      $year = $testsong[0]['year'];
      $genre = $testsong[0]['genre_name'];
      $duration = $testsong[0]['duration'];
      $bpm = $testsong[0]['bpm'];
      $energy = $testsong[0]['energy'];
      $loudness= $testsong[0]['loudness'];
      $liveness = $testsong[0]['liveness'];
      $valence = $testsong[0]['valence'];
      $duration = $testsong[0]['duration'];
      $acousticness = $testsong[0]['acousticness'];
      $speechiness = $testsong[0]['speechiness'];
      $popularity = $testsong[0]['popularity'];
      $danceability = $testsong [0]['danceability'];

 } catch (Exception $e) {
    die( $e->getMessage() ); 
 }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Single song page PLAYING AROUND FOR HTML+CSS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/theFile.css">
        <style>
            .info{
                justify-content: space-around;
            }
             .songitem p span{
                 font-size: larger;
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
            <div class="spTitle"> Song Information</div>
            <p></p>
            <div class="songInformation">
            
            <div class="info">
                <section class="song-general">
                        <ul>
                            <li class="song-title">
                                <h1>
                                    <?php echo $title ;?>
                                </h1>
                            </li>
                            <li class="song-year">
                                <?php echo $year;?>
                            </li>
                            <li class="song-artist">
                                <?php echo "<h2>".$artist."</h2>";?>
                            </li>
                            <li class="song-artist-type">
                                <?php 
                                echo $artistType ;
                                
                                ?>
                            </li>
                            <li class="song-genre">
                                <h2>
                                    <?php echo $genre;?>
                                </h2>
                            </li>
                            <li class="song-duraration">
                                    <?php 
                                        $dur=ConvertDuration($duration);
                                        echo $dur;
                                    ?>
                              
                            </li>
                        </ul>
                </section>
                <section class="song-analysis">
                    
                        <div class="songitem">
                           <h3><u>bpm </u></h3>
                           <p>This song's beats per minute is <span>
                            <?php echo $bpm; ?> </span>
        </p>
                        </div>

                        <div class="songitem">
                            <h3><u>energy </u></h3>
                            <label>min <progress id="file1" max="100" value="<?=$energy?>"> </progress> max</label>
                            <p>The energy of this song is  <span>
                                <?php echo $energy ?> </span>
                            </p>
                        </div>

                        <div class="songitem">
                            <h3><u>danceability</u></h3>
                            <label>min <progress id="file1" max="100" value="<?=$danceability?>"> </progress> max</label>
                            <p>The danceability of this song is <span> 
                                <?php echo $danceability ?> </span>
                            </p>
                        </div>
                        
                        <div class="songitem">
                            <h3><u>Liveness</u></h3>
                            <label>min <progress id="file1" max="100" value="<?=$liveness?>"> </progress> max</label>
                            <p>The liveness of this song is  <span>
                                <?php echo $liveness ?> </span>
                            </p>
                        </div>

                        <div class="songitem">
                        <h3><u>Valence</u></h3>
                        <label>min <progress id="file1" max="100" value="<?=$valence?>"> </progress> max</label>
                            <p>The valence of this song is  <span>
                                <?php echo $valence?></span>
                            </p>
                        </div>

                        <div class="songitem">
                       <h3><u>acousicticness</u></h3>
                       <label>min <progress id="file1" max="100" value="<?=$acousticness?>"> </progress> max</label>
                            <p>The songs acoustic score is <span>
                                <?php echo $acousticness?></span>
                            </p>
                        </div>
                        
                        <div class="songitem">
                            <h3<u>speechiness</u></h3>
                            <label>min <progress id="file1" max="100" value="<?=$speechiness?>"> </progress> max</label>
                            <p>The songs speachiness score is<span>
                            <?php echo $speechiness ?></span>
                        </div>
                        
                        <div class="songitem">
                            <h3<u>popularity</u></h3>
                            <label>min <progress id="file1" max="100" value="<?=$popularity?>"> </progress> max</label>
                            <p>The songs popularity score is <span >
                            <?php echo $popularity ?>
                            </span>
                            
                            </p>
                        </div>
                </section>


            </div>

        </main>
        <footer>
            <p></p>
        </footer>
    </body>
    
</html>