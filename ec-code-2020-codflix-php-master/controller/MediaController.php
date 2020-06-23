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
        $distinctOptions = Media::detailsPages($search, "season_series");
        require('view/detailsView.php');
    }

}
