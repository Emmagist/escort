$(document).ready(function () {
    setInterval(() => {
        loadGiftBalance()
    }, 5000);
});

async function loadGifts() {

    const container =
        document.getElementById('gift-list');

    try {

        const response = await fetch('api/gifts/list.php');

        const data = await response.json();

        if (!data.success) {
            throw new Error('Unable to load gifts');
        }

        container.innerHTML = '';

        data.gifts.forEach(function(gift) {

            const button =
                document.createElement('button');

            button.className = 'gift-item';

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
                    gift.gift_guid,
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
    const response = await fetch('api/gifts/balance.php');
    const data = await response.json();

    if (data.success) {
        document.getElementById('coin-balance').innerText = Number(data.coins).toLocaleString();
    }
}


async function sendGift(giftGuid, name, icon) {

    try {

        const response = await fetch(
            '/api/gifts/send.php',
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    stream_id: streamGuid,
                    gift_guid: giftGuid,
                    quantity: 1
                })
            }
        );


        /*
         * Get raw response first
         * so PHP errors can be seen.
         */

        const raw = await response.text();

        console.log(
            'Send gift HTTP status:',
            response.status
        );

        console.log(
            'Send gift raw response:',
            raw
        );


        let data;

        try {

            data = JSON.parse(raw);

        } catch (jsonError) {

            console.error(
                'Invalid JSON from send.php:',
                raw
            );

            alert(
                'Server returned an invalid response. Check PHP error log.'
            );

            return;
        }


        console.log(
            'Send gift response:',
            data
        );


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


        /*
         * Update balance
         */

        const balanceElement =
            document.getElementById(
                'coin-balance'
            );


        if (balanceElement) {

            balanceElement.innerText =
                Number(
                    data.balance
                ).toLocaleString();
        }


        /*
         * Gift animation
         */

        showGiftAnimation(
            data.gift.name,
            data.gift.icon
        );


        /*
         * Gift count
         */

        const countElement =
            document.getElementById(
                'gift-count'
            );


        if (countElement) {

            countElement.innerText =
                Number(
                    countElement.innerText || 0
                ) + 1;
        }


    } catch (error) {

        console.error(
            'Send gift error:',
            error
        );

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
        .getElementById('coins-modal').classList.add('show');

    loadCoinPackages();
}


function closeBuyCoins() {

    const modal =
        document.getElementById(
            'coins-modal'
        );

    if (modal) {
        modal.classList.remove('show');
    }

}


async function loadCoinPackages() {

    const container =
        document.getElementById(
            'coin-packages'
        );

    const response = await fetch('api/gifts/packages.php');

    const data = await response.json();

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

            startCoinPurchase(pkg.package_guid);

        };

        container.appendChild(item);

    });
}

async function startCoinPurchase(packageguid) {

    if (!packageguid) {
        alert('Invalid coin package.');
        return;
    }

    try {

        const response = await fetch(
            '/api/gifts/purchase.php',
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    package_guid: packageguid
                })
            }
        );

        const data = await response.json();

        if (!data.success) {
            alert(data.message || 'Unable to purchase coins.');
            return;
        }

        // console.log('Coin purchase successful:', data);

        const balanceElement = document.getElementById('coin-balance');

        if (balanceElement && data.wallet) {
            balanceElement.textContent = Number(data.wallet.balance).toLocaleString();
        }

        if (typeof closeBuyCoins === 'function') {
            closeBuyCoins();
        }

        const purchasedCoins = Number(data.purchase.total_coins).toLocaleString();

        alert(`${purchasedCoins} coins added to your wallet!`);

    } catch (error) {

        console.error(
            'Coin purchase error:',
            error
        );

        alert('Unable to complete coin purchase.');
    }
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');

}

async function buyCoins(packageGuid) {
    if (!packageId) {
        return;
    }

    try {
        const response = await fetch(
            'api/gifts/purchase.php',
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    package_id: packageGuid
                })
            }
        );

        const data = await response.json();

        if (!data.success) {
            alert(data.message || 'Unable to purchase coins');

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Update balance immediately
        |--------------------------------------------------------------------------
        */
        const balance = document.getElementById('coin-balance');

        if (balance) {
            balance.innerText = Number(data.wallet.balance).toLocaleString();
        }

        closeBuyCoins();

        alert(
            `${Number(data.purchase.total_coins).toLocaleString()} coins added to your wallet!`
        );
    } catch (error) {

        console.error(
            'Coin purchase error:',
            error
        );

        alert(
            'Unable to complete coin purchase'
        );
    }
}

async function loadCoinBalance() {

    try {

        const response = await fetch(
            'api/gifts/balance.php',
            {
                method: 'GET',
                headers: {'Accept': 'application/json'},
                cache: 'no-store'
            }
        );

        const data = await response.json();

        if (!data.success) {
            return;
        }

        const balance = document.getElementById('coin-balance');

        if (balance) {
            balance.innerText = Number(data.balance).toLocaleString();
        }

    } catch (error) {

        console.error(
            'Balance error:',
            error
        );
    }
}

loadCoinBalance();

loadGifts();
loadGiftBalance();