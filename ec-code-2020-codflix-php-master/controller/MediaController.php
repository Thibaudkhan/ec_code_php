<?php

require_once( 'model/media.php' );
require_once( 'model/historic.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/
/*
 * Show media List page with the right query
 */
function mediaPage()
{

    $search = isset($_GET['title']) ? $_GET['title'] : null;
    $medias = Media::showMedias(null, "SELECT title,trailer_url,release_date,type,season_series FROM media GROUP BY title ORDER BY release_date DESC");
    $AllType = Media::getTypeOfShow();
    require('view/mediaListView.php');
}
/*
 * @param Get the id of the media
 * Show detail page with the right query
 */
function showMoreDetails($search){
    $medias = Media::detailsPages($search);
    $distinctOptions = Media::detailsPages($search, "DISTINCT(season_series), title");
    $TimeForSeries = Media::detailsPages($search,"SEC_TO_TIME( SUM( TIME_TO_SEC(time_of_show))) As timeSum");
    require('view/detailsView.php');
}

/*
* @param Get the id of the media
* Show watch episode page with the right query
 * Add the video to the historic
*/
function watchEpisode($id)
{
    //We use $media and $historic in the view
    $medias = Media::showMedias($id);
    historic::addToHistoric($medias);
    $historics = historic::hisHistoric($id);
    require('view/mediaView.php');
}

