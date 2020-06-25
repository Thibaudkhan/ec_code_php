<?php

/*
 * @param Get the name of the serie and season
 * Filter the season
 */
function chooseSeason(){
    if(!empty($_POST['season'])&& !empty($_POST['seriesTitle'])){
        $season = $_POST['season'];
        $title = $_POST['seasonTitle'];
        $medias = Media::getShowBySeason($season,$title);
        $distinctOptions = Media::detailsPages($title, "DISTINCT(season_series), title");
        $TimeForSeries = Media::detailsPages($title,"SEC_TO_TIME( SUM( TIME_TO_SEC(time_of_show))) As timeSum");
        require('view/detailsView.php');
    }
}
/*
 * @param Get the search form
 * filter by genre, type of media,release Date etc..
 */
function resultFitlerAsc(){
    $symbol = 'LIKE';
    $symbolGenre = '=';
    $search = $_POST['searchValue'];
    $genre = $_POST['genreValue'];
    $releaseDate = $_POST['releaseDate'];
    $typeOfMedia = $_POST['typeOfMedia'];
    $typeOfGenre = $_POST['nbGenre'];
    if($typeOfMedia == "Tout"){
        $symbol = '!=';
    }
    if($typeOfGenre == 0){
        $symbolGenre = '>';
    }

    $AllType = Media::getTypeOfShow();
    $medias = Media::filterMedias($search,$genre,$symbolGenre,$releaseDate,$symbol,$typeOfMedia);

    require('view/components/componentMediaView.php');
}

