<?php

require_once( 'user.php' );

class historic
{

    public function filterMedias(  ) {
        $db   = init_db();
        $user_id =  $_SESSION['user_id'];
        $req  = $db->prepare( "SELECT * FROM media Left Join history ON media.id = history.media_id WHERE  history.user_id=?" );
        $req->execute([$user_id]);
        $db   = null;
        return $req->fetchAll();

    }

    public function deleteHistoric($id,$symbol){
        $db   = init_db();
        $req  = $db->prepare( "DELETE FROM history WHERE  id $symbol?" );
        $req->execute([$id]);
        $db   = null;
        return $req->fetchAll();
    }

    public static function addToHistoric($getTheRow,$finish = 1,$isUpdating = false)
    {
        $db   = init_db();
        $today = date("Y-m-d H:i:s");
        $user_id =  $_SESSION['user_id'];
        //$media_id = $isUpdating ? $getTheRow : $getTheRow[0]['id'];
        if($isUpdating){
            $media_id = $getTheRow;
            $req  = $db->prepare( "Update  history SET finish_date = ?, watch_duration = ? Where user_id =? && media_id = ?" );
            $req->execute(array($today,$finish,$user_id,$media_id));
        }else{
            $media_id = $getTheRow[0]['id'];
            $reqDel  = $db->prepare( "Delete From history Where user_id= ? && media_id=? " );
            $reqDel->execute(array($user_id,$media_id));
            $req  = $db->prepare( "INSERT INTO history(user_id, media_id, start_date, finish_date, watch_duration) VALUES (?,?,?,?,?) " );
            $req->execute(array($user_id,$media_id,$today,$today,$finish));
        }
        $db   = null;
        return $req->fetchAll();
    }


    public static function hisHistoric($id)
    {
        $db   = init_db();
        $user_id =  $_SESSION['user_id'];
        $req  = $db->prepare( "SELECT * FROM history WHERE media_id=? && user_id = ? LIMIT 1" );
        $req->execute(array($id,$user_id));
        $db   = null;
        return $req->fetchAll();
    }

}