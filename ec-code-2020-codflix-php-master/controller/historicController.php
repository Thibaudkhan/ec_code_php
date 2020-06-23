<?php
require_once( 'model/database.php' );
require_once('model/historic.php');


function showHistoric(){
    $historics = new historic();
    $medias = $historics->filterMedias();
     require('view/historicView.php');
}

function deleteHistoric($id){
    $historics = new historic();
    $symbol = "=";
    if($id == 0){
        $symbol = ">";
    }
    $medias = $historics->deleteHistoric($id,$symbol);
    showHistoric();
}
