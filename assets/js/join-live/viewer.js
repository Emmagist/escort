let room = null;
let muted = false;

async function watchStream() {

    try {

        const response = await fetch(
            `api/live/viewer-token.php?stream_id=${encodeURIComponent(streamGuid)}`
        );

        const data = await response.json();

        if (!data.success) {
            alert(data.message || 'Unable to join stream');
            return;
        }

        room = new LivekitClient.Room({
            adaptiveStream: true,
            dynacast: true
        });


        room.on(
            LivekitClient.RoomEvent.TrackSubscribed,
            function(track) {

                const element = track.attach();

                element.style.width = '100%';
                element.style.height = '100%';
                element.style.objectFit = 'contain';

                document
                    .getElementById('remote-video')
                    .innerHTML = '';

                document
                    .getElementById('remote-video')
                    .appendChild(element);

            }
        );


        room.on(
            LivekitClient.RoomEvent.Disconnected,
            function() {

                document
                    .getElementById('remote-video')
                    .innerHTML =
                    '<div class="video-loading">Stream ended</div>';

            }
        );


        await room.connect(
            data.server_url,
            data.token
        );

        startHeartbeat();

    } catch (error) {

        console.error(error);

        document
            .getElementById('remote-video')
            .innerHTML =
            '<div class="video-loading">Unable to connect</div>';
    }
}


function toggleMute() {

    muted = !muted;

    document
        .querySelectorAll('#remote-video video')
        .forEach(function(video) {

            video.muted = muted;

        });

}


function toggleFullscreen() {

    const video =
        document.getElementById('remote-video');

    if (!document.fullscreenElement) {

        video.requestFullscreen();

    } else {

        document.exitFullscreen();

    }
}


function shareStream() {

    if (navigator.share) {

        navigator.share({
            title: 'Live Stream',
            text: 'Join this live stream',
            url: window.location.href
        });

    } else {

        copyStreamLink();

    }
}


function copyStreamLink() {

    navigator.clipboard
        .writeText(window.location.href)
        .then(function() {

            alert('Live stream link copied!');

        });
}


function startHeartbeat() {

    setInterval(function() {

        fetch('api/live/heartbeat.php', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json'
            },

            body: JSON.stringify({
                stream_id: streamGuid
            })

        });

    }, 15000);

}


window.addEventListener(
    'beforeunload',
    function() {

        navigator.sendBeacon(
            'api/live/leave.php',
            JSON.stringify({
                stream_id: streamGuid
            })
        );

    }
);


watchStream();