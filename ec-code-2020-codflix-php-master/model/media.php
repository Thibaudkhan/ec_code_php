<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function showMedias($id = 0,$query = "") {
    $db   = init_db();
    if($id > 0){
        $req  = $db->prepare( "SELECT * FROM media WHERE id=? LIMIT 1" );
        $req->execute(array($id));
    }else{
        $req  = $db->prepare( $query );
        $req->execute();
    }
    $db   = null;
    return $req->fetchAll();
  }

    public static function detailsPages($title,$whatDistinct ="",$nbSeason=1)
    {
        $db   = init_db();
        $req  = !empty($whatDistinct) ?  $db->prepare( "SELECT $whatDistinct FROM media WHERE title Like ? && season_series >= ?" )
        : $db->prepare( "SELECT * FROM media WHERE title Like ? && season_series=?" );
        $req->execute( array( '%' . $title . '%', $nbSeason ));
        $db   = null;
        return $req->fetchAll();
  }


    public static function filterMedias( $title,$genre=0,$symbolGenre='>',$releaseDate="2999-12-31",$symbolType = '!=',$type ) {
        $db   = init_db();
        $req  = $db->prepare( "SELECT * FROM media WHERE title LIKE ? && genre_id $symbolGenre ? && release_date <= ? && type $symbolType ?  GROUP BY title" );
        $req->execute(array('%'.$title.'%',$genre,$releaseDate,'%'.$type.'%'));
        $db   = null;
        return $req->fetchAll();

    }

    public static function getTypeOfShow(){
        $db   = init_db();
        $req  = $db->prepare( "SELECT * FROM genre " );
        $req->execute();
        $db   = null;
        return $req->fetchAll();
    }

    public static function getShowBySeason($nbSeason,$title){
        $db   = init_db();
        $req  = $db->prepare( "SELECT * FROM media  where season_series =?  && title LIKE ?" );
        $req->execute(array($nbSeason,'%'.$title.'%'));
        $db   = null;
        return $req->fetchAll();
    }

    public static function queryApply($query){
        $db   = init_db();
        $req  = $db->prepare($query);
        $req->execute();
        $db   = null;
        return $req->fetchAll();
    }

}
