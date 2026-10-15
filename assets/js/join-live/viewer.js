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



let heartbeatTimer = null;

async function sendHeartbeat() {
    try {
        const response = await fetch('/api/live/heartbeat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                stream_id: streamGuid
            })
        });

        if (!response.ok) {
            throw new Error(`Heartbeat HTTP ${response.status}`);
        }

        const data = await response.json();

        if (!data.success) {
            console.warn('Heartbeat:', data.message);
            return;
        }

        const viewerCount = document.getElementById('live-viewers');

        if (viewerCount) {
            viewerCount.textContent = data.viewer_count;
        }

    } catch (error) {
        console.error('Heartbeat failed:', error);
    }
}

function startHeartbeat() {
    if (heartbeatTimer !== null) {
        return;
    }

    sendHeartbeat();

    heartbeatTimer = setInterval(sendHeartbeat, 15000);
}

function stopHeartbeat() {
    if (heartbeatTimer !== null) {
        clearInterval(heartbeatTimer);
        heartbeatTimer = null;
    }
}

window.addEventListener('pagehide', function () {
    stopHeartbeat();

    const payload = new Blob(
        [JSON.stringify({ stream_id: streamGuid })],
        { type: 'application/json' }
    );

    navigator.sendBeacon('/api/live/leave.php', payload);
});



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