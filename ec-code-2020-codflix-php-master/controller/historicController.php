<?php
require_once( 'model/database.php' );
require_once('model/historic.php');

/*
 * show the historic page
 */
function showHistoric(){
    $historics = new historic();
    $medias = $historics->filterMedias();
    require('view/historicView.php');
}

/*
 * @param Get the id of the row
 *  delete all the historic or one row depending of the id sended
 */
function deleteHistoric($id){
    $historics = new historic();
    $symbol = "=";
    if($id == 0){
        $symbol = ">";
    }
    $medias = $historics->deleteHistoric($id,$symbol);
    showHistoric();
}

/*
 * @ param get the time watching and the id of the video
 * Add to the historic the watching duration
 */
function insertCurrentTimeWatching(){
    $saveTime = intval($_POST['saveTime']) ;
    historic::addToHistoric( $_POST['getId'],$saveTime,true);
}