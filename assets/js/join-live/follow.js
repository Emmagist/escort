async function loadMessages() {

    let lastMessageId = 0;

    try {

        const response =
            await fetch(
                `api/chat/messages.php?stream_id=${encodeURIComponent(streamGuid)}&after_id=${lastMessageId}`
            );

        const data =
            await response.json();

        if (!data.success) {
            return;
        }

        data.messages.forEach(
            function(message) {

                appendChatMessage(
                    message
                );

                lastMessageId =
                    Math.max(
                        lastMessageId,
                        Number(message.id)
                    );

            }
        );

    } catch (error) {

        console.error(error);

    }
}


function appendChatMessage(message) {

    const container =
        document.getElementById(
            'chat-messages'
        );

    const wrapper =
        document.createElement('div');

    wrapper.className =
        'chat-message';

    const initial =
        (
            message.username ||
            message.user_id ||
            'U'
        )
        .substring(0, 1)
        .toUpperCase();

    wrapper.innerHTML = `

        <div class="chat-avatar">
            ${escapeHtml(initial)}
        </div>

        <div class="chat-body">

            <div class="chat-user">
                ${escapeHtml(
                    message.username ||
                    'User'
                )}
            </div>

            <div class="chat-text">
                ${escapeHtml(
                    message.message
                )}
            </div>

        </div>

    `;

    container.appendChild(wrapper);

    container.scrollTop =
        container.scrollHeight;
}


async function sendChatMessage() {

    const input =
        document.getElementById(
            'chat-input'
        );

    const message =
        input.value.trim();

    if (!message) {
        return;
    }

    input.disabled = true;

    try {

        const response =
            await fetch(
                'api/chat/send.php',
                {
                    method: 'POST',

                    headers: {
                        'Content-Type':
                            'application/json'
                    },

                    body: JSON.stringify({

                        stream_id:
                            streamGuid,

                        message:
                            message

                    })
                }
            );

        const data =
            await response.json();

        if (data.success) {

            input.value = '';

        } else {

            alert(
                data.message ||
                'Unable to send message'
            );

        }

    } finally {

        input.disabled = false;

        input.focus();

    }
}


document
    .getElementById('chat-input')
    .addEventListener(
        'keydown',
        function(event) {

            if (
                event.key === 'Enter' &&
                !event.shiftKey
            ) {

                event.preventDefault();

                sendChatMessage();

            }

        }
    );


setInterval(
    loadMessages,
    2000
);

loadMessages();