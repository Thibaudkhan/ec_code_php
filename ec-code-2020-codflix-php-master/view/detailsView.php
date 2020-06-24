<?php ob_start(); ?>


<div class="row">
    <form method="post" action="">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <?php
                foreach( $distinctOptions as $option ){
                    echo "<option>saison ".$option['season_series']."</option>";
                }

                ?>
            </select>
            <button type="submit" class="btn btn-block bg-red">Valider</button>

        </div>
    </form>

</div>
<div class="container-fluid mb-3">
    <?php foreach( $TimeForSeries as $times ){
   echo "Temps de visonage pour tous les épisodes de la série réunis <b>".$times['timeSum']."</b>";
    }?>
</div>
<div class="media-list">
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
