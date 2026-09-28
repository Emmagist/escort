async function loadGifts() {

    const container =
        document.getElementById('gift-list');

    try {

        const response =
            await fetch('api/gifts/list.php');

        const data =
            await response.json();

        if (!data.success) {
            throw new Error('Unable to load gifts');
        }

        container.innerHTML = '';

        data.gifts.forEach(function(gift) {

            const button =
                document.createElement('button');

            button.className =
                'gift-item';

            button.innerHTML = `
                <span class="gift-icon">
                    ${escapeHtml(gift.icon)}
                </span>

                <span class="gift-name">
                    ${escapeHtml(gift.name)}
                </span>

                <span class="gift-price">
                    ${Number(gift.coins).toLocaleString()} coins
                </span>
            `;

            button.onclick = function() {

                sendGift(
                    gift.id,
                    gift.name,
                    gift.icon
                );

            };

            container.appendChild(button);

        });

    } catch (error) {

        container.innerHTML =
            '<div class="gift-loading">Unable to load gifts</div>';

    }
}


async function loadGiftBalance() {

    const response =
        await fetch('api/gifts/balance.php');

    const data =
        await response.json();

    if (data.success) {

        document.getElementById(
            'coin-balance'
        ).innerText =
            Number(data.coins).toLocaleString();

    }
}


async function sendGift(
    giftId,
    name,
    icon
) {

    try {

        const response = await fetch(
            'api/gifts/send.php',
            {
                method: 'POST',

                headers: {
                    'Content-Type':
                        'application/json'
                },

                body: JSON.stringify({

                    stream_id: streamGuid,

                    gift_id: giftId,

                    quantity: 1

                })
            }
        );

        const data =
            await response.json();

        if (!data.success) {

            if (
                data.message ===
                'Insufficient coin balance'
            ) {

                openBuyCoins();

                return;
            }

            alert(
                data.message ||
                'Unable to send gift'
            );

            return;
        }


        document.getElementById(
            'coin-balance'
        ).innerText =
            Number(data.balance).toLocaleString();


        showGiftAnimation(
            data.gift.name,
            data.gift.icon
        );


        const countElement =
            document.getElementById(
                'gift-count'
            );

        countElement.innerText =
            Number(countElement.innerText) + 1;


    } catch (error) {

        console.error(error);

        alert(
            'Unable to send gift'
        );

    }
}


function showGiftAnimation(
    name,
    icon
) {

    document.getElementById(
        'gift-popup-icon'
    ).innerText = icon;

    document.getElementById(
        'gift-popup-title'
    ).innerText =
        name + ' Sent!';

    document.getElementById(
        'gift-popup-sub'
    ).innerText =
        'Your gift was sent to the streamer';


    const popup =
        document.getElementById(
            'gift-popup'
        );

    popup.classList.add('show');

    setTimeout(function() {

        popup.classList.remove('show');

    }, 1800);
}


function openBuyCoins() {

    document
        .getElementById('coins-modal')
        .classList.add('show');

    loadCoinPackages();
}


function closeBuyCoins() {

    document
        .getElementById('coins-modal')
        .classList.remove('show');

}


async function loadCoinPackages() {

    const container =
        document.getElementById(
            'coin-packages'
        );

    const response =
        await fetch(
            'api/gifts/packages.php'
        );

    const data =
        await response.json();

    if (!data.success) {
        return;
    }

    container.innerHTML = '';

    data.packages.forEach(function(pkg) {

        const item =
            document.createElement('button');

        item.className =
            'coin-package';

        item.innerHTML = `

            <strong>
                ${Number(pkg.coins).toLocaleString()}
                coins
            </strong>

            <span>
                ₦${Number(pkg.price).toLocaleString()}
            </span>

        `;

        item.onclick = function() {

            startCoinPurchase(
                pkg.package_guid
            );

        };

        container.appendChild(item);

    });
}


function escapeHtml(value) {

    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

}


loadGifts();
loadGiftBalance();