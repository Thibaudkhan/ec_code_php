<?php ob_start(); ?>

<div class="row">
    <h1 name="title" id="title2">Details de la page <?php echo $medias[0]['title'];?> </h1>
    <div class="form-group">
        <form method="post" action="index.php?filter=searchSeason">
            <input style="display: none;" name="seriesTitle" value="<?php echo $medias[0]['title'];?>" readonly>
            <label for="exampleFormControlSelect1">Example select</label>
            <select  name="season" class="form-control" id="season">
                <?php
                foreach( $distinctOptions as $option ){
                    echo '<option value="'.$option["season_series"].'">'.$option['season_series'].'</option>';
                }
                ?>
            </select>
            <button  class="btn btn-block bg-red">Valider</button>
        </form>
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
                    <iframe  id="player" allowfullscreen="" frameborder="0" src="<?= $media['trailer_url']; ?>" ></iframe>
                </div>
            </div>
            <div id="title" class="title"><?= $media['title']; ?></div>
            <div class="d-flex justify-content-between" style="text-decoration: none;color: #fff;">
                <p class="p-2" ><?= $media['short_description']; ?></p>
                <p class="p-2" ><?= $media['name_of_episode']; ?></p>
                <p class="p-2" ><?= $media['time_of_show']; ?></p>
            </div>
            <div id="title" class="title"><?= "episode " .$media['current_episode']; ?></div>

        </a>
    <?php endforeach; ?>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
