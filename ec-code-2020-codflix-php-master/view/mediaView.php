<?php ob_start(); ?>

<div  class="media-list personalMedia" id="tableResult">
    <?php foreach( $medias as $media ): ?>
        <a class="item" href="index.php?media=<?= $media['title']; ?>">
            <div class="video">
                <div>
                    <iframe  allowfullscreen="" frameborder="0"
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
