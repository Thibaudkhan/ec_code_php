<?php

require_once( 'model/media.php' );
require_once( 'model/historic.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::showMedias(null,"SELECT title,trailer_url,release_date,type,season_series FROM media GROUP BY title ORDER BY release_date DESC" );
  $AllType = Media::getTypeOfShow();
  require('view/mediaListView.php');

}


class MediaController {

    public  function showMoreDetails($search){
        $medias = Media::detailsPages($search);
        $distinctOptions = Media::detailsPages($search, "DISTINCT(season_series), title");
        $TimeForSeries = Media::detailsPages($search,"SEC_TO_TIME( SUM( TIME_TO_SEC(time_of_show))) As timeSum");
        require('view/detailsView.php');
    }

    public function watchEpisode($id)
    {
        $medias = Media::showMedias($id);
        $historics = historic::hisHistoric($id);
        historic::addToHistoric($medias);
        require('view/mediaView.php');

    }

}
