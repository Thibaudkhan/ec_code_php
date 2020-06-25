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
    window.onload = function() {
        watch();
    }
    function youtube_parser(url){
        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
        var match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    }

    var oldPlayer = document.getElementById('oldPlayer');
    var timeDuration = document.getElementById('timeDuration').textContent;
    console.log(oldPlayer.textContent);
    var idVideo = youtube_parser(oldPlayer.textContent);

    var tag = document.createElement('script');

    function watch() {
        tag.src = "https://www.youtube.com/iframe_api";

        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        loadPlayer(idVideo);

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
        //event.target.playVideo();
    }

    function getPlayer(){

    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            $(window).bind('beforeunload', function(){
                var saveTime = event.target.getCurrentTime();
                var getId = document.getElementById('idMedia').textContent;
                $("#tempo").load("index.php?historic=saveTime", {
                    saveTime: saveTime,
                    getId : getId
                });
                return 'Are you sure you want to leave?';
            });
            //setTimeout(stopVideo, 5000);
            setTimeout(function() {
                stopVideo(event);
            }, 4000)

            done = true;
        }
    }


    function stopVideo(event) {

    }

    function sendInfo(){

    }

    //jquery




</script>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
