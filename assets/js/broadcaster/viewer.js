let room = null;

async function watchStream(streamGuid)
{
    try {

        const response = await fetch(
            `../../api/viewer-token.php?stream_id=${streamGuid}`
        );

        const data = await response.json();

        if (!data.success) {

            alert(data.message);

            return;
        }

        room = new LivekitClient.Room({
                adaptiveStream: true,
                dynacast: true
            });

        room.on(
            LivekitClient.RoomEvent.TrackSubscribed,
            (
                track,
                publication,
                participant
            ) => {

                const element =
                    track.attach();

                document.getElementById('remote-video').appendChild(element);
            }
        );

        await room.connect(
            data.server_url,
            data.token
        );

        console.log(
            'Connected to stream'
        );

    } catch (error) {

        console.error(error);

        alert('Unable to watch stream');
    }
}