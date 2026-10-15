
(function () {
    'use strict';

    let likeButton;
    let likeCount;
    let floatingLikes;

    let likeRequestPending = false;
    let countRequestPending = false;

    function initLikes() {
        likeButton = document.getElementById('like-btn');
        likeCount = document.getElementById('like-count');
        floatingLikes = document.getElementById('floating-likes');

        if (!likeButton || !likeCount) {
            console.error('Likes: required HTML elements are missing.');
            return;
        }

        if (typeof streamGuid === 'undefined' || !streamGuid) {
            console.error('Likes: streamGuid is missing.');
            return;
        }

        likeButton.disabled = false;

        loadCount();
        setInterval(loadCount, 3000);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLikes, {
            once: true
        });
    } else {
        initLikes();
    }

    async function loadCount() {
        if (countRequestPending) return;

        countRequestPending = true;

        try {
            const response = await fetch('api/likes/like-count.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    stream_id: streamGuid
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                updateCount(data.count);
            }
        } catch (error) {
            console.error('Like count error:', error);
        } finally {
            countRequestPending = false;
        }
    }

    function updateCount(count) {
        likeCount = document.getElementById('like-count');

        if (!likeCount) return;

        const number = Number(count);
        likeCount.textContent = Number.isFinite(number)
            ? Math.max(0, number)
            : 0;
    }

    window.likeStream = async function () {
        if (likeRequestPending) return;

        if (
            !likeButton ||
            typeof streamGuid === 'undefined' ||
            !streamGuid
        ) {
            console.error('Like button or stream ID is missing.');
            return;
        }

        likeRequestPending = true;

        try {
            const response = await fetch('api/likes/like.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    stream_id: streamGuid
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            const data = await response.json();

            if (!data.success) {
                console.warn(data.message || 'Unable to like stream.');
                return;
            }

            updateCount(data.count);

            // Restart the button animation on every click.
            likeButton.classList.remove('like-pop');
            void likeButton.offsetWidth;
            likeButton.classList.add('like-pop');

            createFloatingHeart();

            setTimeout(() => {
                if (likeButton) {
                    likeButton.classList.remove('like-pop');
                }
            }, 450);

        } catch (error) {
            console.error('Like request error:', error);
        } finally {
            likeRequestPending = false;
        }
    };

    function createFloatingHeart() {
        floatingLikes = document.getElementById('floating-likes');

        if (!floatingLikes) {
            console.error('Floating hearts container not found.');
            return;
        }

        const heart = document.createElement('span');

        heart.className = 'floating-heart';
        heart.textContent = '❤️';
        heart.setAttribute('aria-hidden', 'true');

        heart.style.left = `${20 + Math.random() * 60}%`;
        heart.style.setProperty(
            '--drift',
            `${Math.floor(Math.random() * 100) - 50}px`
        );

        floatingLikes.appendChild(heart);

        heart.addEventListener('animationend', () => {
            heart.remove();
        }, { once: true });

        // Fallback cleanup if CSS animation does not finish.
        setTimeout(() => heart.remove(), 2500);
    }
})();
