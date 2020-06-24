
<div class="media-list" id="tableResult" style="width: 100%;">
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