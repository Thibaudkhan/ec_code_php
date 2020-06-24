<?php

Class FilterController{



}


function resultFitlerAsc(){
    $symbol = 'LIKE';
    $symbolGenre = '=';
    $search = $_POST['searchValue'];
    $genre = $_POST['genreValue'];
    $releaseDate = $_POST['releaseDate'];
    $typeOfMedia = $_POST['typeOfMedia'];
    $typeOfgenre = $_POST['nbGenre'];
    if($typeOfMedia == "Tout"){
        $symbol = '!=';
    }
    if($typeOfgenre == 0){
        $symbolGenre = '>';
    }

    $AllType = Media::getTypeOfShow();
    $medias = Media::filterMedias($search,$genre,$symbolGenre,$releaseDate,$symbol,$typeOfMedia);

    require('view/components/componentMediaView.php');
}

