<?php


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

        //return $req->fetchAll();
    }

}