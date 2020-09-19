<?php
$media_all = json_decode($media_json, true);
$currentItem = $_COOKIE["currentItem"];
?>
<div class="player-content">
    <div class="container">
        <?php foreach ($media_all

                       as $index => $media) : ?>

            <?php if ($currentItem == $index) : ?>
                <div class="top wyy">

                    <div class="video-player <?php if ($media['type'] == 'audio') {
                        echo "audio-player";
                    } elseif ($media['type'] == 'image') {
                        echo "image-player";
                    } ?>" id="video-player-container">
                        <?php foreach ($marquee as $key => $value) : ?>

                            <?php if ($media['type'] == 'image') : ?>
                                <?= $this->Html->image('/uploads/files/' . $media['file'], array('class' => 'player_image')) ?>

                            <?php elseif ($media['type'] == 'audio') : ?>
                                <?= $this->Html->media('/uploads/files/' . $media['file'], array('class' => 'audio_player', 'controls' => 'true')) ?>

                            <?php else: ?>
                                <?= $this->Html->media('/uploads/files/' . $media['file'],
                                    array('poster' => '/uploads/files/1563779618avatar.png', 'class' => 'player', 'id' => 'player', 'type' => 'video/mp4',
                                        'muted' => 'muted', 'preload' => 'none')) ?>
                            <?php endif; ?>

                            <?php if ($value['logo_display']): ?>
                                <?= $this->Html->image('/uploads/logo/' . $value['logo'] . '', array('class' => 'player-tv-logo')) ?>
                            <?php endif; ?>


                            <div class="btn-container">
                                <div class="btn-play" id="playpause" title="play">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>

                            <div id="controls" class="video-control-buttons">

                                <div class="progress-bar">
                                    <div id="custom-seekbar">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="time-bar">
                                    <span id="duration"></span>
                                    <span id="current-time"></span>
                                </div>
                                <div class="volume-bar" id="volumeBar">
                                    <div class="muted" id="muted" onclick="videomute();">
                                        <i class="fas fa-volume-up"></i>
                                    </div>

                                    <input id="vol-control" class="volume-slider" type="range" min="0" max="100"
                                           step="1"
                                           oninput="SetVolume(this.value)"
                                           onchange="SetVolume(this.value)" title="volume level slider">
                                </div>
                                <?php if ($media['type'] != 'audio') : ?>
                                    <div class="fullscreen">
                                        <?= $this->Html->image('full-screen-icon.png', array('class' => 'full-screen-btn', 'id' => 'fullScreenButton')) ?>
                                        <i class="fas fa-compress-arrows-alt" id="close"></i>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <?php if ($value['marque_display']): ?>
                                <div class="running-line">
                                    <h3 class="title"><?= __('מדע'); ?></h3>
                                    <div class="description" id="marquee">
                        <span class="running-text" id="text">

                            <?= $value['text'] ?>

                            </span>
                                    </div>

                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                    <?php for ($i = 0; $i < count($media_all); $i++) : ?>
                        <?php if ($index == $i) : ?>
                            <div id="playlist" class="playlist">
                                <div class="playlist-item">
                                    <h2 class="title"><?= __('רשימת השמעה: מדע'); ?></h2>
                                    <div class="description">
                                        <p>
                                            <?= __('הבא'); ?>
                                        </p>
                                        <div class="next_vid_cont">
                                            <?php if (isset($media_all[$i + 1]['name'])) : ?>
                                                <span><?= __($media_all[$i + 1]['name']); ?></span>
                                            <?php else : ?>
                                                <span><?= __('סוף'); ?></span>
                                            <?php endif; ?>
                                            <span id="playlistItemDur">
                                        <i class="fas fa-clock"></i>
                                                <?= __('10 דק'); ?>
                                    </span>
                                        </div>
                                        <div class="arrows">
                                            <?php if ($currentItem < (count($media_all)) - 1) : ?>
                                                <i id="playlistRight" onclick="nextPlaylistItem();"
                                                   class="fas fa-chevron-right"></i>
                                            <?php endif; ?>
                                            <?php if ($currentItem > 0) : ?>
                                                <i id="playlistLeft" onclick="prevPlaylistItem();"
                                                   class="fas fa-chevron-left"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

                <div class="middle">
                    <div class="video-description">
                        <h2 class="title">
                            <?= __($media['name']); ?>
                        </h2>
                        <div class="details">
                <span class="date">
                    <?= __('20 במרץ'); ?>
                </span>
                            <span class="duration">
                        <i class="fas fa-clock"></i>
                                <?= __('10 דק'); ?>
                </span>
                        </div>

                    </div>
                </div>
            <?php else: ?>

            <?php endif; ?>

            <style>
/* styles only if specific media type */
                <?php if ($media['type'] == 'audio') : ?>
                .top .video-player.audio-player {
                    min-width: 75%;
                    min-height: 150px;
                }

                .top .video-player.audio-player .btn-container {
                    top: 5%;
                }

                .audio-player .btn-container, .audio-player #controls {
                    display: none;
                    visibility: hidden;
                    opacity: 0;
                }

                .audio_player {
                    width: 90%;
                    margin-top: 25px;
                }

                <?php else: ?>
                <?php endif; ?>

                <?php if ($media['type'] == 'image') : ?>
                .image-player .btn-container, .image-player #controls {
                    display: none;
                    visibility: hidden;
                    opacity: 0;
                }

                <?php else: ?>
                <?php endif; ?>

            </style>

        <?php endforeach; ?>
    </div>
</div>



<script>
    console.log(<?= $media_json ?>);
    // Play/pause btn
    var video = document.getElementById("player");
    var playpause = document.getElementById("playpause");
    playpause.addEventListener("click", function () {
        if (video.paused || video.ended) {
            playpause.title = "pause";
            playpause.innerHTML = "<i class=\"fas fa-pause\"></i>";
            video.muted = false;
            video.play();
        }
        else {
            playpause.title = "play";
            playpause.innerHTML = "<i class=\"fas fa-play\"></i>";
            video.pause();
        }
    });

    //    Full screen btn
    var fullScreenButton = document.getElementById("fullScreenButton");
    var fullScreenCont = document.getElementById("video-player-container");
    var closeFullscreenButton = document.getElementById("close");
    // Open fullscreen
    if (typeof(fullScreenButton) != "undefined" && fullScreenButton !== null && typeof(fullScreenCont) != "undefined" && fullScreenCont !== null) {
        fullScreenButton.addEventListener("click", function () {
                if (fullScreenCont.requestFullscreen) {
                    fullScreenCont.requestFullscreen();
                } else if (fullScreenCont.mozRequestFullScreen) { /* Firefox */
                    fullScreenCont.mozRequestFullScreen();
                } else if (fullScreenCont.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                    fullScreenCont.webkitRequestFullscreen();
                } else if (fullScreenCont.msRequestFullscreen) { /* IE/Edge */
                    fullScreenCont.msRequestFullscreen();
                }

                $("#close").css("display", "flex");
                $("#fullScreenButton").css("display", "none");
            }
        );
    }
    // Close fullscreen
    if (typeof(closeFullscreenButton) != "undefined" && closeFullscreenButton !== null) {
        closeFullscreenButton.addEventListener("click", function () {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }

            $("#close").css("display", "none");
            $("#fullScreenButton").css("display", "flex");
        });
    }

    //Show current time/duration time
    if (typeof(video) != "undefined" && video !== null) {
        video.ontimeupdate = function () {
            var percentage = ( video.currentTime / video.duration ) * 100;
            $("#custom-seekbar span").css("width", percentage + "%");

            setInterval(function () {
                var curTime = video.currentTime;
                var curMinutes = Math.floor(curTime / 60);
                var curSeconds = Math.floor(curTime % 60);
                var formattedCurMin = curMinutes < 10 ? "0" + curMinutes : curMinutes;
                var formattedCurSec = curSeconds < 10 ? "0" + curSeconds : curSeconds;

                $("#current-time").html(formattedCurMin + ":" + formattedCurSec);
            });

            setInterval(function () {
                var durTime = video.duration;
                var durMinutes = Math.floor(durTime / 60);
                var durSeconds = Math.floor(durTime % 60);
                var formattedDurMin = durMinutes < 10 ? "0" + durMinutes : durMinutes;
                var formattedDurSec = durSeconds < 10 ? "0" + durSeconds : durSeconds;

                $("#duration").html(formattedDurMin + ":" + formattedDurSec + ' / ');
            });
        };
    }


    //    Progress bar
    $("#custom-seekbar").on("click", function (e) {
        var offset = $(this).offset();
        var left = (e.pageX - offset.left);
        var totalWidth = $("#custom-seekbar").width();
        var percentage = ( left / totalWidth );
        var videoTime = video.duration * percentage;
        video.currentTime = videoTime;
    });

    //    Volume mute btn hovering
    var delay = 1000, setTimeoutConst;
    $("#volumeBar").hover(function () {
        $("#vol-control").show();
    }, function () {
        setTimeoutConst = setTimeout(function () {
            $("#vol-control").hide();
        }, delay);
    });

    //    Volume mute btn
    function videomute() {
        if (video.muted) {
            video.muted = false;
            document.getElementById('muted').innerHTML = "<i class=\"fas fa-volume-up\"></i>";
        } else {
            video.muted = true;
            document.getElementById('muted').innerHTML = "<i class=\"fas fa-volume-mute\"></i>"
        }
    }


    //    Volume level changing
    function SetVolume(val) {
        var player = document.getElementById("player");
        player.volume = val / 100;
    }

    // Playlist control
    function nextPlaylistItem() {
        curCookie = Number(getCookie("currentItem"));
        document.cookie = ("currentItem=" + (curCookie + 1));
        window.location.reload();
    }

    function prevPlaylistItem() {
        curCookie = Number(getCookie("currentItem"));
        document.cookie = ("currentItem=" + (curCookie - 1));
        window.location.reload();
    }

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    $(document).ready(function () {
        if (typeof(getCookie("currentItem")) != 'undefined' && getCookie("currentItem") !== null) {
        } else {
            document.cookie = ("currentItem=0");
            window.location.reload();
        }
    });

</script>

