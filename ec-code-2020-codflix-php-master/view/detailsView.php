<?php ob_start(); ?>

<script>
    function btn_click() {
        var title = document.getElementById("title").value;
        //alert(title);
        var season = document.getElementById("season");
        var strseason = season.options[season.selectedIndex].value;
        $("#tableResult").load("index.php?filter=searchSeason",{
            season: strseason
            //title: title
        });
    }
</script>

<div class="row">
    <h1 id="title">Details de la page <?php echo $medias[0]['title'];?> </h1>
    <div class="form-group">

        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" id="season">
            <?php
            foreach( $distinctOptions as $option ){
                echo '<option value="'.$option["season_series"].'">'.$option['season_series'].'</option>';
            }

            ?>
        </select>
        <button onclick="btn_click()" class="btn btn-block bg-red">Valider</button>
    </div>
</div>
<div class="container-fluid mb-3">
    <?php foreach( $TimeForSeries as $times ){
   echo "Temps de visonage pour tous les épisodes de la série réunis <b>".$times['timeSum']."</b>";
    }?>
</div>
<div class="media-list" id="tableResult">
    <?php foreach( $medias as $media ): ?>
        <a class="item" href="index.php?media=<?= $media['id']; ?>">
            <div class="video">
                <div>
                    <div  ></div>
                    <iframe  id="player" allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div class="d-flex justify-content-between" style="text-decoration: none;color: #fff;">
                <p class="p-2" ><?= $media['short_description']; ?></p>
                <p class="p-2" ><?= $media['time_of_show']; ?></p>
            </div>

        </a>
    <?php endforeach; ?>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
