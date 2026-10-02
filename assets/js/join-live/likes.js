let streamLiked = false;

async function likeStream() {

    if (streamLiked) {
        return;
    }

    try {

        const response = await fetch('api/likes/like.php',{
            method: 'POST',

            headers: {
                'Content-Type':
                    'application/json'
            },

            body: JSON.stringify({
                stream_id: streamGuid
            })
        });

        const data = await response.json();

        if (!data.success) {
            return;
        }

        streamLiked = true;

        const button =
            document.getElementById(
                'like-button'
            );

        button.classList.add('liked');

        button.innerHTML = '❤️ Liked'; alert(data.count); console.log(data.count);

        document.getElementById('like-count').innerText = Number(data.count);

        createFloatingHeart();

    } catch (error) {

        console.error(error);

    }
}


function createFloatingHeart() {

    const container =
        document.getElementById(
            'floating-likes'
        );

    const heart =
        document.createElement('span');

    heart.className =
        'floating-heart';

    heart.innerHTML = '❤️';

    heart.style.setProperty(
        '--x',
        `${Math.floor(
            Math.random() * 100
        ) - 50}px`
    );

    container.appendChild(heart);

    setTimeout(function() {

        heart.remove();

    }, 1500);
}