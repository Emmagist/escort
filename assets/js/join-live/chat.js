$(document).ready(function () {
    setInterval(() => {
        loadMessages()
    }, 2000);
});

let lastMessageId = 0;

async function loadMessages() {
    try {

        const response =
            await fetch(
                `api/chat/messages.php?stream_id=${encodeURIComponent(streamGuid)}&after_id=${lastMessageId}`
            );

        const data = await response.json();

        if (!data.success) {
            return;
        }

        data.messages.forEach(
            function(message) {

                appendChatMessage(message);

                // lastMessageId = Math.max(lastMessageId, Number(message.id));

            }
        );

    } catch (error) {

        console.error(error);

    }
}


function appendChatMessage(message) {

    const chatContainer =
        document.getElementById('chat-messages');

    if (chatContainer) {

        const wrapper =
            document.createElement('div');

        wrapper.className = 'chat-message';

        const username =
            message.username ||
            message.name ||
            'User';

        const text =
            message.message ||
            '';

        const avatar =
            message.avatar ||
            '';

        const firstLetter =
            username.charAt(0).toUpperCase();

        wrapper.innerHTML = `

            <div class="chat-avatar">

                ${
                    avatar
                    ? `<img
                        src="${escapeChatHtml(avatar)}"
                        alt=""
                        onerror="this.style.display='none';"
                    >`
                    : firstLetter
                }

            </div>

            <div class="chat-body">

                <div class="chat-user">
                    ${escapeChatHtml(username)}
                </div>

                <div class="chat-text">
                    ${escapeChatHtml(text)}
                </div>

            </div>

        `;

        chatContainer.appendChild(wrapper);

        /*
         * Keep normal chat scrolled to bottom
         */

        chatContainer.scrollTop =
            chatContainer.scrollHeight;
    }


    /*
    |--------------------------------------------------------------------------
    | TIKTOK STYLE VIDEO COMMENT
    |--------------------------------------------------------------------------
    */

    showLiveVideoComment(message);
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

        const response = await fetch('api/chat/send.php',{
            method: 'POST',

            headers: {
                'Content-Type':
                    'application/json'
            },

            body: JSON.stringify({
                stream_id: streamGuid,
                message: message
            })
        });

        const data = await response.json();

        if (data.success) {input.value = '';} else {
            alert(data.message || 'Unable to send message');
        }

    } finally {

        input.disabled = false;

        input.focus();

    }
}


document.getElementById('chat-input').addEventListener('keydown', function(event) {

    if (
        event.key === 'Enter' &&
        !event.shiftKey
    ) {

        event.preventDefault();

        sendChatMessage();

    }

});

function showLiveVideoComment(message) {

    const container = document.getElementById('live-comments-overlay') || document.getElementById('chat-messages');

    if (!container) {
        return;
    }


    const username =
        message.username ||
        message.name ||
        'User';


    const text =
        message.message ||
        '';


    const avatar =
        message.avatar ||
        '';


    /*
    |--------------------------------------------------------------------------
    | Create comment
    |--------------------------------------------------------------------------
    */

    const comment =
        document.createElement('div');

    comment.className =
        'live-comment';


    /*
    |--------------------------------------------------------------------------
    | Avatar
    |--------------------------------------------------------------------------
    */

    const firstLetter =
        username
            .charAt(0)
            .toUpperCase();


    const avatarHtml =
        avatar

        ? `
            <img
                src="${escapeChatHtml(avatar)}"
                alt=""
                onerror="
                    this.style.display='none';
                    this.parentElement.innerText='${firstLetter}';
                "
            >
        `

        : firstLetter;


    comment.innerHTML = `

        <div class="live-comment-avatar">

            ${avatarHtml}

        </div>


        <div class="live-comment-body">

            <div class="live-comment-user">

                ${escapeChatHtml(username)}

            </div>


            <div class="live-comment-text">

                ${escapeChatHtml(text)}

            </div>

        </div>

    `;


    /*
    |--------------------------------------------------------------------------
    | Add to video
    |--------------------------------------------------------------------------
    */

    container.appendChild(comment);


    /*
    |--------------------------------------------------------------------------
    | Keep only latest comments
    |--------------------------------------------------------------------------
    */

    while (container.children.length > 7) {

        container.removeChild(
            container.firstElementChild
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Remove after animation
    |--------------------------------------------------------------------------
    */

    setTimeout(() => {

        if (comment.parentNode) {

            comment.remove();

        }

    }, 8000);

}

function escapeChatHtml(value) {

    const div =
        document.createElement('div');

    div.textContent =
        String(value ?? '');

    return div.innerHTML;
}


// loadMessages();