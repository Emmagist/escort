
let room = null;

let selectedGift = null;

let giftQuantity = 1;


/*
|--------------------------------------------------------------------------
| STREAM
|--------------------------------------------------------------------------
*/

async function watchStream(streamGuid)
{
    try {

        const response = await fetch(
            `api/viewer-token.php?stream_id=${encodeURIComponent(streamGuid)}`
        );


        const data = await response.json();


        if (!data.success) {

            alert(data.message);

            window.location.href = 'live-list';

            return;
        }


        room = new LivekitClient.Room({

            adaptiveStream: true,

            dynacast: true

        });


        room.on(

            LivekitClient.RoomEvent.TrackSubscribed,

            (track, publication, participant) => {

                const element =
                    track.attach();


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


        await room.connect(

            data.server_url,

            data.token

        );


        console.log(
            'Connected to LiveKit'
        );


        loadGiftBalance();


        loadMessages(streamGuid);


        startViewerRefresh(streamGuid);


    } catch (error) {

        console.error(error);

        alert('Unable to watch stream');

    }
}


/*
|--------------------------------------------------------------------------
| VIEWER COUNT
|--------------------------------------------------------------------------
*/

function startViewerRefresh(streamGuid)
{
    setInterval(async () => {

        try {

            const response =
                await fetch(
                    `api/live-stats.php?stream_id=${encodeURIComponent(streamGuid)}`
                );


            const data =
                await response.json();


            if (data.success) {

                document
                    .getElementById('viewer-count')
                    .innerText =
                    Number(data.viewer_count)
                    .toLocaleString();


                document
                    .getElementById('online-count')
                    .innerText =
                    Number(data.viewer_count)
                    .toLocaleString()
                    + ' online';

            }

        } catch (error) {

            console.error(error);

        }

    }, 10000);
}


/*
|--------------------------------------------------------------------------
| LIKE
|--------------------------------------------------------------------------
*/

async function sendLike()
{
    const streamGuid =
        window.streamGuid;


    try {

        const response =
            await fetch(
                'api/live-like.php',
                {
                    method: 'POST',

                    headers: {
                        'Content-Type':
                            'application/json'
                    },

                    body: JSON.stringify({

                        stream_id:
                            streamGuid

                    })
                }
            );


        const data =
            await response.json();


        if (data.success) {

            document
                .getElementById('like-count')
                .innerText =
                Number(data.like_count)
                .toLocaleString();


            showFloatingReaction('❤️');

        }

    } catch (error) {

        console.error(error);

    }
}


/*
|--------------------------------------------------------------------------
| FLOATING HEART
|--------------------------------------------------------------------------
*/

function showFloatingReaction(icon)
{
    const container =
        document.getElementById(
            'floating-reactions'
        );


    const element =
        document.createElement('span');


    element.className =
        'floating-reaction';


    element.innerText =
        icon;


    element.style.left =
        (Math.random() * 80 + 10) + '%';


    container.appendChild(element);


    setTimeout(() => {

        element.remove();

    }, 2000);
}


/*
|--------------------------------------------------------------------------
| GIFTS
|--------------------------------------------------------------------------
*/

function openGiftModal()
{
    const modal =
        new bootstrap.Modal(
            document.getElementById(
                'giftModal'
            )
        );


    modal.show();


    loadGiftBalance();
}


function selectGift(element)
{
    document
        .querySelectorAll('.gift-item')
        .forEach(item => {

            item.classList.remove(
                'selected'
            );

        });


    element.classList.add('selected');


    selectedGift = {

        id:
            element.dataset.giftId,

        name:
            element.dataset.giftName,

        price:
            Number(
                element.dataset.giftPrice
            )

    };


    giftQuantity = 1;


    document
        .getElementById(
            'gift-quantity'
        )
        .innerText = '1';


    document
        .getElementById(
            'selected-gift-name'
        )
        .innerText =
            selectedGift.name;


    document
        .getElementById(
            'selected-gift-section'
        )
        .style.display = 'block';
}


function changeGiftQuantity(amount)
{
    giftQuantity += amount;


    if (giftQuantity < 1) {

        giftQuantity = 1;

    }


    if (giftQuantity > 100) {

        giftQuantity = 100;

    }


    document
        .getElementById(
            'gift-quantity'
        )
        .innerText =
        giftQuantity;
}


async function sendGift()
{
    if (!selectedGift) {

        alert('Select a gift first');

        return;
    }


    const button =
        document.querySelector(
            '.send-gift-btn'
        );


    button.disabled = true;


    try {

        const response =
            await fetch(
                'api/send-gift.php',
                {
                    method: 'POST',

                    headers: {

                        'Content-Type':
                            'application/json'

                    },

                    body: JSON.stringify({

                        stream_id:
                            window.streamGuid,

                        gift_id:
                            selectedGift.id,

                        quantity:
                            giftQuantity

                    })
                }
            );


        const data =
            await response.json();


        if (!data.success) {

            alert(data.message);

            return;
        }


        updateGiftBalance(
            data.balance
        );


        showFloatingReaction(
            selectedGift.name === 'Rose'
                ? '🌹'
                : '🎁'
        );


        addChatMessage(
            'You',
            `sent ${giftQuantity}x ${selectedGift.name} 🎁`
        );


        const modal =
            bootstrap.Modal
                .getInstance(
                    document.getElementById(
                        'giftModal'
                    )
                );


        modal.hide();


    } catch (error) {

        console.error(error);

        alert(
            'Unable to send gift'
        );

    } finally {

        button.disabled = false;

    }
}


/*
|--------------------------------------------------------------------------
| GIFT BALANCE
|--------------------------------------------------------------------------
*/

async function loadGiftBalance()
{
    try {

        const response =
            await fetch(
                'api/live-wallet.php'
            );


        const data =
            await response.json();


        if (data.success) {

            updateGiftBalance(
                data.balance
            );

        }

    } catch (error) {

        console.error(error);

    }
}


function updateGiftBalance(balance)
{
    const formatted =
        Number(balance)
            .toLocaleString();


    const main =
        document.getElementById(
            'coin-balance'
        );


    const modal =
        document.getElementById(
            'modal-coin-balance'
        );


    if (main) {

        main.innerText =
            formatted;

    }


    if (modal) {

        modal.innerText =
            formatted;

    }
}


/*
|--------------------------------------------------------------------------
| CHAT
|--------------------------------------------------------------------------
*/

async function sendMessage()
{
    const input =
        document.getElementById(
            'chat-input'
        );


    const message =
        input.value.trim();


    if (!message) {

        return;

    }


    try {

        const response =
            await fetch(
                'api/live-message.php',
                {
                    method: 'POST',

                    headers: {

                        'Content-Type':
                            'application/json'

                    },

                    body: JSON.stringify({

                        stream_id:
                            window.streamGuid,

                        message:
                            message

                    })
                }
            );


        const data =
            await response.json();


        if (data.success) {

            addChatMessage(
                'You',
                message
            );


            input.value = '';

        } else {

            alert(data.message);

        }

    } catch (error) {

        console.error(error);

    }
}


function addChatMessage(
    username,
    message
)
{
    const container =
        document.getElementById(
            'chat-messages'
        );


    const row =
        document.createElement(
            'div'
        );


    row.className =
        'chat-message';


    row.innerHTML = `

        <strong>
            ${escapeHtml(username)}
        </strong>

        <span class="chat-message-text">
            ${escapeHtml(message)}
        </span>

    `;


    container.appendChild(row);


    container.scrollTop =
        container.scrollHeight;
}


async function loadMessages(streamGuid)
{
    try {

        const response =
            await fetch(
                `api/live-messages.php?stream_id=${encodeURIComponent(streamGuid)}`
            );


        const data =
            await response.json();


        if (!data.success) {

            return;

        }


        const container =
            document.getElementById(
                'chat-messages'
            );


        container.innerHTML = '';


        data.messages.forEach(
            message => {

                addChatMessage(
                    message.username,
                    message.message
                );

            }
        );

    } catch (error) {

        console.error(error);

    }
}


/*
|--------------------------------------------------------------------------
| SHARE
|--------------------------------------------------------------------------
*/

async function shareLiveStream()
{
    const url =
        window.location.href;


    if (navigator.share) {

        try {

            await navigator.share({

                title:
                    'Live Stream',

                text:
                    'Join this live stream',

                url:
                    url

            });

        } catch (error) {

            console.log(
                'Share cancelled'
            );

        }

    } else {

        await navigator.clipboard.writeText(
            url
        );


        alert(
            'Live stream link copied'
        );

    }
}


/*
|--------------------------------------------------------------------------
| BUY COINS
|--------------------------------------------------------------------------
*/

function openBuyCoins()
{
    const giftModal =
        bootstrap.Modal.getInstance(
            document.getElementById(
                'giftModal'
            )
        );


    if (giftModal) {

        giftModal.hide();

    }


    const modal =
        new bootstrap.Modal(
            document.getElementById(
                'buyCoinsModal'
            )
        );


    modal.show();
}


function buyCoins(amount)
{
    /*
     * Connect this to your existing
     * Squad payment flow.
     */

    window.location.href =
        `buy-live-coins?amount=${amount}`;
}


/*
|--------------------------------------------------------------------------
| FOLLOW
|--------------------------------------------------------------------------
*/

document
    .getElementById('follow-btn')
    ?.addEventListener(
        'click',
        followStreamer
    );


document
    .getElementById('follow-main-btn')
    ?.addEventListener(
        'click',
        followStreamer
    );


async function followStreamer()
{
    try {

        const response =
            await fetch(
                'api/follow-streamer.php',
                {
                    method: 'POST',

                    headers: {

                        'Content-Type':
                            'application/json'

                    },

                    body: JSON.stringify({

                        streamer_id:
                            window.streamerId

                    })
                }
            );


        const data =
            await response.json();


        if (data.success) {

            document
                .querySelectorAll(
                    '#follow-btn, #follow-main-btn'
                )
                .forEach(button => {

                    button.innerText =
                        data.following
                            ? 'Following'
                            : 'Follow';

                });

        }

    } catch (error) {

        console.error(error);

    }
}


/*
|--------------------------------------------------------------------------
| HTML ESCAPE
|--------------------------------------------------------------------------
*/

function escapeHtml(value)
{
    const div =
        document.createElement(
            'div'
        );


    div.textContent =
        value;


    return div.innerHTML;
}
