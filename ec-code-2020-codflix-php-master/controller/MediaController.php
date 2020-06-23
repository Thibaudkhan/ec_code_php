<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::filterMedias( $search );

  require('view/mediaListView.php');

}

class MediaController {

    public  function showMoreDetails($search){
        echo $search;
        $medias = Media::detailsPages($search);
        $distinctOptions = Media::detailsPages($search, "DISTINCT(season_series)");
        $TimeForSeries = Media::detailsPages($search,"SEC_TO_TIME( SUM( TIME_TO_SEC(time_of_show))) As timeSum");
        require('view/detailsView.php');
    }

}
