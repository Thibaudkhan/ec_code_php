
<div class="media-list" id="tableResultComponent" style="    width: 100%;">
    <?php foreach( $medias as $media ): ?>
        <a class="item" href="index.php?detailMedia=<?= $media['title']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0" src="<?= $media['trailer_url']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div class="p-0 text-center text-white"><?= $media['release_date']; ?></div>
        </a>
    <?php endforeach; ?>
</div>