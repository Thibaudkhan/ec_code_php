<?php

require_once( 'user.php' );

class historic
{

    public function filterMedias(  ) {

        // Open database connection
        $db   = init_db();
        $user_id =  $_SESSION['user_id'];
        $req  = $db->prepare( "SELECT * FROM media Left Join history ON media.id = history.media_id WHERE  history.user_id=?" );
        $req->execute([$user_id]);

        // Close databse connection
        $db   = null;

        return $req->fetchAll();

    }

    public function deleteHistoric($id,$symbol){
        $db   = init_db();
        $req  = $db->prepare( "DELETE FROM history WHERE  id $symbol?" );
        $req->execute([$id]);

        // Close databse connection
        $db   = null;

        return $req->fetchAll();
    }

    public static function addToHistoric($getTheRow)
    {

        $db   = init_db();
        $today = date("Y-m-d H:i:s");

        $media_id = $getTheRow[0]['id'];
        $user_id =  $_SESSION['user_id'];
        $req  = $db->prepare( "INSERT INTO history(user_id, media_id, start_date, finish_date, watch_duration) VALUES (?,?,?,?,?) " );
        $req->execute(array($user_id,$media_id,$today,$today,10));

        // Close databse connection
        $db   = null;

        return $req->fetchAll();
    }

}