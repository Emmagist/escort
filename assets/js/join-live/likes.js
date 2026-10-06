const likeCount = document.getElementById('like-count');

$(document).ready(function () {

    const like = likeCount.getAttribute('data-id');

    setInterval(() => {
        loadCount(like);
    }, 2000);

});

async function loadCount(param) {
    try {
        const response = await fetch('api/likes/like-count.php',{
            method: 'POST',

            headers: {
                'Content-Type':
                    'application/json'
            },

            body: JSON.stringify({
                stream_id: param,
            })
        });

        const data = await response.json();

        if (data.success) {
            likeCount.innerText = Number(data.count);
        }

    } catch (error) {
        console.error(error);
    }
}

async function likeStream() {

    let streamLiked = false;

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

        const button = document.getElementById('like-button');

        button.classList.add('liked');

        button.innerHTML = '❤️ Liked';

        likeCount.innerText = Number(data.count);

        createFloatingHeart();

        setTimeout(() => {
            button.classList.remove('liked');
            // button.classList.add('like');
            button.innerHTML = '❤️ Like';
        }, 3000);
        

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