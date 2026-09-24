$('#go_live_button').click(function () {
    $('#golive').modal('show');
});

/*
=========================================
FRONTEND GIFT PREVIEW
=========================================
*/



function previewGift(name, icon, price) {

    const animation =
        document.getElementById('gift-animation');

    const giftIcon =
        animation.querySelector('.gift-icon');

    const giftName =
        document.getElementById('gift-animation-name');

    giftIcon.textContent = icon;

    giftName.textContent =
        name + ' • 🪙 ' + price.toLocaleString();

    animation.style.display = 'flex';

    setTimeout(function () {

        animation.style.display = 'none';

    }, 3000);
}


/*
=========================================
CHAT FRONTEND ONLY
=========================================
*/

const button = document.getElementById('golive_button');
button.addEventListener('click', async function () {

    const titleInput = document.getElementById('stream_title');
    const message = document.getElementById('alert-danger');

    const title = titleInput.value.trim();

    if (!title) {
        // message.style.display = 'block';
        message.innerHTML = 'Please enter a stream title';
        // message.style.display = 'none';
        return;
    }

    try {
        button.innerHTML = 'Creating stream...';

        const response = await fetch('api/create-stream.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({title:title})
        });

        const data = await response.json();

        if (!data.success) {
            message.innerText = data.message || 'unable to create stream.';
            button.innerHTML = 'Go Live';

            return;
        }

        // Stream guid
        const streamGuid = data.stream.stream_guid;
        const streamer = document.getElementById('streamer').value = streamGuid;
        input = document.getElementById('streamer').value;
        // alert(input);
        startBroadcast(streamGuid);
        // $('#paymentButton').click();
    } catch (error) {
        console.error(error);
        message.innerText = 'Unable to create stream.';
        button.innerHTML = 'Go Live';
    }
});

function sendChatMessage() {

    const input =
        document.getElementById('chat-input');

    const message =
        input.value.trim();

    if (!message) {
        return;
    }

    const chat =
        document.getElementById('chat-messages');

    const item =
        document.createElement('div');

    item.className = 'chat-message';

    item.innerHTML =
        '<strong>You:</strong> ' +
        escapeHtml(message);

    chat.appendChild(item);

    chat.scrollTop =
        chat.scrollHeight;

    input.value = '';
}


function escapeHtml(text) {

    const div =
        document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}

/**
 * ---------------------------------------
 * CREATE STREAM
 * ---------------------------------------
 */

let room = null;

async function startBroadcast(streamGuid)
{
    try {

        const response = await fetch(
            `api/broadcaster-token.php?stream_id=${encodeURIComponent(streamGuid)}`
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

        await room.connect(
            data.server_url,
            data.token
        );

        await room.localParticipant.enableCameraAndMicrophone();

        room.localParticipant.videoTrackPublications.forEach(publication => {

                if (publication.track) {

                    const video = publication.track.attach();

                    document.getElementById('local-video').appendChild(video);
                }
            });

        console.log('Broadcast started');

        document.getElementById('status').innerText = 'LIVE';
        $('#go_live_button').hide();

    } catch (error) {

        console.error(error);

        alert('Unable to start broadcast');
    }
}

async function endBroadcast(streamGuid){
    if (room) {

        await room.disconnect();

        room = null;
    }

    const formData = new FormData();

    formData.append('stream_id', streamGuid);

    const response = await fetch('api/end-stream.php', {method: 'POST', body: formData}
        );

    const data = await response.json();

    if (data.success) {

        document.getElementById('status').innerText = 'ENDED';

        alert('Stream ended');
    }
}