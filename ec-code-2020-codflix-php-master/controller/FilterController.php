<?php

Class FilterController{



}


function chooseSeason(){
    $season = $_POST['season'];
    //$title = $_POST['title'];
    //echo "ok". $title;
    $medias = Media::getShowBySeason($season);
    //var_dump($medias[0]['title']);
    require('view/components/componentMediaViewDetails.php');

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

