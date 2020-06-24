<?php

Class FilterController{



}


function chooseSeason(){
    if(!empty($_POST['season'])&& !empty($_POST['seasonTitle'])){
        $season = $_POST['season'];
        $title = $_POST['seasonTitle'];
        //$title = $_POST['title'];

        $medias = Media::getShowBySeason($season,$title);
        $distinctOptions = Media::detailsPages($title, "DISTINCT(season_series), title");
        $TimeForSeries = Media::detailsPages($title,"SEC_TO_TIME( SUM( TIME_TO_SEC(time_of_show))) As timeSum");
        //var_dump($medias[0]['title']);
        require('view/detailsView.php');
    }

}

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

