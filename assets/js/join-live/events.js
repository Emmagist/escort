
let lastLiveEventId = 0;
let liveEventTimer = null;
let liveEventRequestInProgress = false;

function escapeLiveEventText(value) {
    const span = document.createElement('span');
    span.textContent = String(value ?? '');
    return span.innerHTML;
}

function showLiveEvent(event) {
    const overlay = document.getElementById('live-event-overlay');

    if (!overlay) return;

    const payload = event.payload || {};
    const gift = payload.gift || {};

    let message = '';
    let icon = '✨';

    switch (event.type) {
        case 'like':
            icon = '❤️';
            message = `${payload.actor_name || event.user_id} liked the stream`;
            break;

        case 'follow':
            icon = '💚';
            message = `${payload.actor_name || event.user_id} started following`;
            break;

        case 'share':
            icon = '🔗';
            message = `${payload.actor_name || event.user_id} shared the stream`;
            break;

        case 'join':
            icon = '👋';
            message = `${payload.actor_name || event.user_id} joined the live`;
            break;

        case 'gift': {
            icon = '🎁';

            const giftName =
                gift.name ||
                gift.title ||
                gift.gift_name ||
                'a gift';

            const quantity = Math.max(1, Number(payload.quantity) || 1);
            message =
                `${payload.actor_name || event.user_id} sent ${quantity} × ${giftName}`;
            break;
        }

        default:
            return;
    }

    const item = document.createElement('div');
    item.className = `live-event-item ${event.type}`;
    item.innerHTML =
        `<span>${icon}</span><span>${escapeLiveEventText(message)}</span>`;

    overlay.appendChild(item);

    // Keep the overlay from growing indefinitely.
    while (overlay.children.length > 5) {
        overlay.firstElementChild.remove();
    }

    setTimeout(() => {
        item.classList.add('leaving');
        setTimeout(() => item.remove(), 400);
    }, 4500);
}

async function pollLiveEvents() {
    if (liveEventRequestInProgress || !streamGuid) return;

    liveEventRequestInProgress = true;

    try {
        const url =
            `/api/live/events.php?stream_id=${encodeURIComponent(streamGuid)}` +
            `&after_id=${lastLiveEventId}`;

        const response = await fetch(url, {
            credentials: 'same-origin',
            cache: 'no-store'
        });

        const raw = await response.text();

        let data;

        try {
            data = JSON.parse(raw);
        } catch {
            console.error('Live events returned invalid JSON:', raw);
            return;
        }

        if (!response.ok || !data.success) {
            console.warn('Live events:', data.message || response.status);
            return;
        }

        for (const event of data.events || []) {
            lastLiveEventId = Math.max(
                lastLiveEventId,
                Number(event.id) || 0
            );

            showLiveEvent(event);
        }
    } catch (error) {
        console.error('Unable to poll live events:', error);
    } finally {
        liveEventRequestInProgress = false;
    }
}

function startLiveEvents() {
    if (liveEventTimer !== null) return;

    pollLiveEvents();
    liveEventTimer = setInterval(pollLiveEvents, 1500);
}

function stopLiveEvents() {
    if (liveEventTimer !== null) {
        clearInterval(liveEventTimer);
        liveEventTimer = null;
    }
}

startLiveEvents();

window.addEventListener('pagehide', stopLiveEvents);
