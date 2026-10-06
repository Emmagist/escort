const button = document.getElementById('follow-btn');

$(document).ready(function () {
    // const followButton = button.getAttribute('data-id');
    loadFollower();
});

async function loadFollower() {
    try {
        const response = await fetch('api/follow/follower.php',{
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({streamer_id:streamerId})
        });

        const data = await response.json();

        if (data.following) {
            button.innerHTML = 'Following';
            button.classList.add('following');
            button.disabled = true;
        }
    } catch (error) {
        console.error(error);
    }
}

async function followStreamer() {

    if (!button) {
        return;
    }

    button.disabled = true;

    try {
        const response = await fetch('api/follow/follow.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({streamer_id:streamerId})
        });

        const data = await response.json();

        if (!data.success) {
            alert(data.mssage || 'Unable to follow streamer');
            button.disabled = false;
            return;
        }

        button.innerHTML = 'Following';
        button.classList.add('following');
        button.disabled = true;

    } catch (error) {
        console.error(error);
        button.disabled = false;
    }
}