<?php
class DatabaseHelper {
       /*  Returns a connection object to a database  */
       public static function createConnection( $values=array() ) {
        $connString = $values[0];
        $user = $values[1];
        $password = $values[2];
        $pdo = new PDO($connString,$user,$password); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
        return $pdo;
    }
    /*Runs the specified SQL query using the passed connection and 
    the passed array of parameters (null if none)*/
    public static function runQuery($connection, $sql, $parameters) { 
        $statement = null;
         // if there are parameters then do a prepared statement
        if (isset($parameters)) {
            // Ensure parameters are in an array
            if (!is_array($parameters)) {
                $parameters = array($parameters); 
            }
            // Use a prepared statement if parameters
            $statement = $connection->prepare($sql); 
            $executedOk = $statement->execute($parameters); 
            if (! $executedOk) throw new PDOException;
            } else {
               // Execute a normal query
                $statement = $connection->query($sql);
               if (!$statement) throw new PDOException; 
            }
            return $statement;
        }
}

#
#Class for the artistDb 
#
class ArtistDB{
    // build a baseSQL for the artistdb so when refering to any artist it will gather these things
    private static $baseSQL= " SELECT artist_id, artist_name, artist_type_id
                            FROM artists 
                            ORDER BY artist_name ";
    private static $topArtsql = "SELECT artists.artist_name AS `Artist`, COUNT(song_id) AS `Count` FROM artists\n"

    . "    INNER JOIN songs ON artists.artist_id = songs.artist_id\n"

    . "    GROUP BY artists.artist_id\n"

    . "    ORDER BY `Count` DESC LIMIT 10\n";

    public function __construct($connection){
        $this->pdo = $connection; 
    }
    public function getAll() { 
        $sql = self::$baseSQL; 
        $statement =DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getTopArtists(){
        $sql=self::$topArtsql;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
}
class GenresDB{
    private static $baseSQL= " SELECT genre_id, genre_name FROM genres ORDER BY genre_name";
    private static $topGenSQL = "SELECT genres.genre_name AS `Genre`, COUNT(song_id) AS `Count`\n"
    . "              FROM genres\n"
    . "              INNER JOIN songs ON genres.genre_id = songs.genre_id\n"
    . "              GROUP BY genres.genre_id ORDER BY `Count` DESC LIMIT 10 \n ";
    public function __construct($connection){
        $this->pdo=$connection;
    }
    public function getAll(){
        $sql = self::$baseSQL; 
        $statement =DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getTopGenres(){
        $sql=self::$topGenSQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
}
class SongsDB{
    private static $baseSQL= "SELECT  song_id, songs.title, artist_name, year, genre_name, bpm, danceability, energy, loudness, liveness, valence, duration, acousticness, speechiness, popularity, duration
    FROM genres 
    INNER JOIN (artists INNER JOIN songs 
                        ON artists.artist_id = songs.artist_id) 
    ON genres.genre_id = songs.genre_id";
    
    private static $artistTypeSQL="SELECT song_id, songs.title AS `Song`, artist_name As`Artist`, year, type_name As `TypeName` 
    FROM types 
    INNER JOIN (artists INNER JOIN songs 
                        ON artists.artist_id = songs.artist_id) 
    ON types.type_id = artists.artist_type_id";

    private static $topPopSQL="SELECT songs.title AS `Song`, songs.year AS `Year`, artists.artist_name AS `Artist`, songs.song_id AS `SongID` 
    FROM artists 
    INNER JOIN songs ON artists.artist_id = songs.artist_id 
    GROUP BY artists.artist_id 
    ORDER BY songs.popularity DESC 
    LIMIT 10";
    
    private static $onehitsSQL= "SELECT artists.artist_name AS `Artist`, songs.title AS `Song`, songs.song_id AS `SongID`
    FROM songs
    INNER JOIN artists ON artists.artist_id = songs.artist_id
    GROUP BY songs.artist_id
    HAVING COUNT(songs.song_id) = 1
    ORDER BY songs.popularity DESC
    LIMIT 10";
    
    private static $acousticnessSQL = "SELECT title AS `Song`, acousticness, duration, song_id AS `SongID`, artist_name AS `Artist`
    FROM songs
    INNER JOIN artists ON  songs.artist_id = artists.artist_id
    WHERE acousticness > 40
    ORDER BY duration DESC
    LIMIT 10";

    private static $clubSQL="SELECT title AS `Song`, (danceability * 1.6 + energy * 1.4) AS `Clubbing`,  songs.song_id AS `SongID`, artist_name AS `Artist`
    FROM songs
    INNER JOIN artists ON  songs.artist_id = artists.artist_id
    WHERE danceability > 80
    ORDER BY `Clubbing` DESC
    LIMIT 10";

    private static $runningSQL="SELECT title AS `Song`, (energy * 1.3 + valence * 1.6) AS `Running`, songs.song_id AS `SongID`, artist_name AS `Artist`
    FROM songs
    INNER JOIN artists ON  songs.artist_id = artists.artist_id
    WHERE bpm BETWEEN 120 AND 125
    ORDER BY `Running` DESC
    LIMIT 10";

    private static $studySQL="SELECT title AS `Song`, (acousticness*0.8)+(100-speechiness)+(100-valence) AS `Studying`, songs.song_id AS `SongID`, artist_name AS `Artist`
    FROM songs
    INNER JOIN artists ON  songs.artist_id = artists.artist_id
    WHERE bpm BETWEEN 100 AND 125
    AND speechiness BETWEEN 1 AND 20
    ORDER BY `Studying` DESC
    LIMIT 10";

    public function __construct($connection) {
        $this->pdo = $connection; 
    }
    public function getAll() { 
        $sql = self::$baseSQL; 
        $statement =DatabaseHelper::runQuery($this->pdo, $sql, null);
        return $statement->fetchAll();
    }
    public function getAllForArtist($artist_id) {
        $sql = self::$baseSQL . " WHERE songs.artist_id=?"; 
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,Array($artist_id));
        return $statement->fetchAll();
   } 
    public function getAllForGenres($genre_id){
        $sql = self::$baseSQL . " WHERE songs.genre_id=?"; 
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,Array($genre_id));
        return $statement->fetchAll();
    }
    public function getAllForTitleInput($title){
         $sql = self::$baseSQL . " WHERE songs.title LIKE '%".$title."%'";
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getAllForYearLess($yearLess){
        //echo $yearLess;
        $sql = self::$baseSQL . " WHERE `year`<".$yearLess ;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getAllForYearMore($yearMore){
        //echo $yearMore;
        $sql = self::$baseSQL . " WHERE `year`>".$yearMore ;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getSongWSongId($songidGiven){
        $sql = self::$baseSQL . " WHERE song_id=".$songidGiven;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getAllForPopLess($popLess){
        $sql = self::$baseSQL . " WHERE `popularity`<".$popLess ;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getAllForPopMore($popMore){
        $sql = self::$baseSQL . " WHERE `popularity`>".$popMore ;
        $statement = DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getAverageofSomething($value){
        $avgsql = "SELECT AVG(".$value.") from songs";
        $statement = DatabaseHelper::runQuery($this->pdo, $avgsql,null);
        return $statement;
    }
    public function getTopPop(){
        $sql=self::$topPopSQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getOneHitWonders(){
        $sql=self::$onehitsSQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getacousticness(){
        $sql=self::$acousticnessSQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getAtClub(){
        $sql=self:: $clubSQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getRunningSongs(){
        $sql=self:: $runningSQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getStudySongs(){
        $sql=self:: $studySQL;
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,null);
        return $statement->fetchAll();
    }
    public function getArtistType($song_id){
        $sql=self::$artistTypeSQL ." WHERE song_id=?";
        $statement=DatabaseHelper::runQuery($this->pdo, $sql,Array($song_id));
        return $statement->fetchAll()[0]["TypeName"];
    }
}


?>