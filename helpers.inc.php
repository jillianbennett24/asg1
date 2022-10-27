<?php

/*Outputs the basics for a single page */
function outputSong($results){
    if ($results){
        foreach ($results as $row){
            outputSingleSong($row);
        }
    }
}
function outputSingleSong($row){    
    echo "song id:";
    echo $row['song_id'];
    echo "<br>";
    echo $row['title'];
    echo "<br>";
}
/* output the dropdown list for the search page for ARTISTS! */
function outputArtists($artists){
    if($artists){
        foreach($artists as $row){
            outputSingleArtistForDD($row);
        }
    }
}
function outputSingleArtistForDD($row){
    echo "<option value='".$row['artist_id']."'>";
    echo $row['artist_name'];
    echo "</option>";
}
/*OUTPUT the dropdown list for the search page for GENRES*/ 
function outputGenres($genres){
    if($genres){
        foreach($genres as $row){
            outputSingleGenreForDD($row);
        }
    }
}
function outputSingleGenreForDD($row){
    echo "<option value='".$row['genre_id']."'>";
    echo $row['genre_name'];
    echo "</option>";
}
// output songs 
function outputSongs($songs){
    print_r($songs);
     if($songs){
        foreach($songs as $row){
            outputSingleSongForSR($row);
        }
    }
    
}
function outputSingleSongForSR($row){
    echo "<p> title: ";
    echo $row['title'];
    echo "</p>";
    echo "<p> artist: ";
    echo $row['artist_name'];
    echo "</p>";
    echo "<p> year: ";
    echo $row['year'];
    echo "</p>";
    echo "<p> genre: ";
    echo $row['genre_name'];
    echo "</p>";
}

function outputSongsInRow($songs){
    if(isset($songs)){
        foreach($songs as $row){
            outputSingleSongTD($row);
        }
    }
}
function outputSingleSongTD($row){
    $songid=$row['song_id'];
    ?>
    <tr>
        <td><?=$row['title']?> </td>
        <td><?=$row['artist_name']?> </td>
        <td><?=$row['year']?> </td>
        <td><?=$row['genre_name']?> </td>
        <td><?=$row['popularity']?> </td>
        <!-- <td>
            <form method="get" action="./addToFavorites.php?song_id=<?=$songid?>">
            <button type='submit' name="song_id" value=<?=$songid?>>add to fav</button>
        </form>
        </td> -->
        <td class='connecter'>
            <a href='ssp.php?song_id=<?=$songid?>'>View  </a>
        </td>
        <td class='addfav'>
            <a  href="addToFavorites.php?id=<?=$songid?>">Add to Favorites</a>
        </td>
</tr>
<?php
}
?>
<!--     
    echo "<td>".$row['year']."</td>";
    echo "<td>".$row['genre_name']."</td>";
    echo "<td>".$row['popularity']."</td>";
    echo "<td> ";
   //echo "<button type='submit' formaction='addfav.php?id=".$row['song_id'].">View</button>";
   //echo "<form action= 'ssp.php?".$row['song_id']."'medod='get' id='SSDisplayButton'><button type='submit' form='SSDisplayButton' value='Submit'>View</button>";
        // THIS ONE WORKS JUST NOT RIGHT WRITING 
   //echo "<form action='ssp.php?".$row['song_id']."' method='get'><input type='submit' name='song_id' value='".$row['song_id']."'/> </form>";
//    echo $songid;

   echo "<a href='ssp.php?song_id="1015">View</a>";
   //echo "<button formaction='./ssp.php?id='".$songid."'>View</button>";
    echo "</td>";
    echo "<td> ";
    //echo "<form action='fav.php?".$row['song_id']."' method='get'><input type='submit' name='song_id' value='".$row['song_id']."'/> </form>";
    echo "</td>";
    ECHO "</TR>"; -->
<?php
function outputSongInRowFav($testsong){
    $songid=$testsong[0]['song_id'];
    ?>
    
    <tr>
                        <td><?=$testsong[0]['title']?></td>
                        <td><?=$testsong[0]['artist_name']?></td>
                        <td><?=$testsong[0]['year']?></td>
                        <td><?=$testsong[0]['genre_name']?></td>
                        <td><?=$testsong[0]['popularity']?></td>
                        <td class='connecter'>
                            <a href='ssp.php?song_id=<?=$songid?>'>View </a>
                        </td>
                    </tr>
    
<?php 
}

function ConvertDuration($seconds){
    $sec=$seconds%60;
    $mins = ($seconds/60)%60;
    return "<p> ".$mins.":".$sec." minutes</p>";
}
function outputTopGenres($topgenres){
    foreach($topgenres as $val){
   ?>
    <tr>
     <td><?=$val['Genre']?></td>
     <td><?=$val['Count']?></td>
    </tr>
   <?php
       }
}
function outputTopArtist($topartist){
    foreach($topartist as $val){
   ?>
    <tr>
     <td><?=$val['Artist']?></td>
     <td><?=$val['Count']?></td>
    </tr>
   <?php
       }
}
function outputTopPop($top){
    foreach($top as $val){
        $songid= $val['SongID'];
   ?>
    <tr>
    <td><a href='ssp.php?song_id=<?=$songid?>' class="normal"><?=$val['Song']?></td>
     <td><?=$val['Artist']?></td>
     
    </tr>
   <?php
       }
}
function outputOneHit($hits){
    foreach($hits as $val){
        $songid= $val['SongID'];
   ?>
    <tr>
    <td><a href='ssp.php?song_id=<?=$songid?>' class="normal"><?=$val['Song']?></td>
     <td><?=$val['Artist']?></td>
    </tr>
   <?php
       }
}
function acousticnessOutput($aclong){
    foreach($aclong as $val){
        $songid=$val['SongID'];
        $durationConverted =ConvertDuration($val['duration']);
        ?>
        <tr>
        <td><a href='ssp.php?song_id=<?=$songid?>' class="normal"><?=$val['Song']?></td>
        <td><?=$val['Artist']?></td>
        <td><?=$val['acousticness']?></td>
        <td><?=$durationConverted?></td>
        </tr>
        <?php
    }
}
function outputAtClub($clubs){
    foreach($clubs as $val){
        $songid=$val['SongID'];
        ?>
        <tr>
        <td><a href='ssp.php?song_id=<?=$songid?>' class="normal"><?=$val['Song']?></td>
        <td><?=$val['Artist']?></td>
        <td><?=$val['Clubbing']?></td>
    
        </tr>
        <?php
    }
}
function outputRunning($run){
    foreach($run as $val){
        $songid=$val['SongID'];
        ?>
        <tr>
        <td><a href='ssp.php?song_id=<?=$songid?>' class="normal"><?=$val['Song']?></td>
        <td><?=$val['Artist']?></td>
        <td><?=$val['Running']?></td>
        </tr>
        <?php
    }
}
function outputStudying($study){
    foreach($study as $val){
        $songid=$val['SongID'];
        ?>
        <tr>
        <td><a href='ssp.php?song_id=<?=$songid?>' class="normal"><?=$val['Song']?></td>
        <td><?=$val['Artist']?></td>
        <td><?=$val['Studying']?></td>
     
        </tr>
        <?php
    }
}


?>