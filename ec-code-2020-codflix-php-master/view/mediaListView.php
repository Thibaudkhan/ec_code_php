<?php ob_start(); ?>

<script>
    function btn_click() {
        var searchValue = document.getElementById("search").value;
        var typeOfgenre = document.getElementById("genre");
        var strTypeOfgenre = typeOfgenre.options[typeOfgenre.selectedIndex].value;
        var typeOfMedia = document.getElementById("typeOfMedia");
        var strTypeOfMedia = typeOfMedia.options[typeOfMedia.selectedIndex].text;
        var releaseDate = document.getElementById("releaseDate").value;
        var genreValue = document.getElementById("genre").value;
        $("#tableResult").load("index.php?filter=ascSearch",{
            searchValue: searchValue,
            genreValue: genreValue,
            releaseDate: releaseDate,
            typeOfMedia : strTypeOfMedia,
            nbGenre: strTypeOfgenre
        });


    }
</script>


    <div class="container">
        <div class="form-group">
            <label for="typeOfMedia">Type à voir</label>
            <select class="form-control" id="typeOfMedia">
                <option>Tout</option>
                <option>film</option>
                <option>série</option>
            </select>
            <label for="genre">Genre à voir</label>
            <select class="form-control" id="genre">
                <option value="0">Tout</option>
                <?php
                foreach ($AllType as $type) {
                        echo '<option value="'.$type["id"].'">'.$type['name'].'</option>';
                    }
                ?>
            </select>
            <label for="releaseDate">sortie avant</label>
            <input class="form-control" type="date" id="releaseDate" name="releaseDate" value="2020-06-24">
            <label for="search">rechercher</label>
            <input  type="search" id="search" name="title" value="<?=  $search; ?>" class="form-control"
                   placeholder="Rechercher un film ou une série">

            <button onclick="btn_click()"  class="btn btn-block bg-red mt-3 mb-5">Valider</button>
        </div>
    </div>


<div class="media-list" id="tableResult">
    <?php foreach( $medias as $media ): ?>
        <a class="item" href="index.php?detailMedia=<?= $media['title']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div class="p-0 text-center text-white"><?= $media['release_date']; ?></div>
        </a>
    <?php endforeach; ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
