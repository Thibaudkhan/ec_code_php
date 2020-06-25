<?php ob_start(); ?>



<div  class="media-list personalMedia" id="tableResult">

    <?php foreach( $medias as $media ): ?>
            <div class="video">
                <div id="tempo">
                    <div style="display: none;"  id="oldPlayer"><?= $media['trailer_url']; ?></div>
                    <div style="display: none;"  id="idMedia"><?= $media['id']; ?></div>
                    <div  id="player"></div>
                </div>
            </div>
            <div  class="p-0 text-center text-white"><?= $media['release_date']; ?></div>
    <?php endforeach; ?>
    <?php foreach( $historics as $historic ): ?>
        <div style="display: none;" id="timeDuration"><?= $historic['watch_duration'] ?></div>
    <?php endforeach; ?>

</div>
<script>

    var oldPlayer = document.getElementById('oldPlayer');
    var timeDuration = document.getElementById('timeDuration').textContent;
    var idVideo = youtube_parser(oldPlayer.textContent);
    var tag = document.createElement('script');

    window.onload = function() {
        watch();
    }

    function watch() {
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        loadPlayer(idVideo);
    }

    function youtube_parser(url){
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        var match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }

    function loadPlayer(idVideo) {
        window.onYouTubePlayerAPIReady = function() {
            test(idVideo);
        };
    }

    function test(idVideo) {
        player = new YT.Player('player', {
            height: '360',
            width: '640',
            videoId: idVideo,
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        event.target.loadVideoById(idVideo, timeDuration)
    }

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING) {
            $(window).bind('beforeunload', function(){
                var saveTime = event.target.getCurrentTime();
                var getId = document.getElementById('idMedia').textContent;
                $("#tempo").load("index.php?historic=saveTime", {
                    saveTime: saveTime,
                    getId : getId
                });
                return 'Are you sure you want to leave?';
            });
        }
    }

</script>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
