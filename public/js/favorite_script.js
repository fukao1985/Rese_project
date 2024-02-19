document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    console.log(favoriteButtons);
    console.log("adding active class");
    console.log("removing active class");

    function setFavoriteButtonColors(favorites) {
        console.log("setFavoriteButtonColors");
        favoriteButtons.forEach(button => {
            const shopId = button.dataset.shopId;
            if (favorites.includes(parseInt(shopId))) {
                button.classList.add('active');
                console.log(`Button with shopId ${shopId} is active`);
            } else {
                button.classList.remove('active');
                console.log(`Button with shopId ${shopId} is not active`);
            }
        });
    }

    function updateDatabaseAndColors(shopId) {
        fetch('/shop/favorite/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ shop_id: shopId }),
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            // お気に入り登録後にお気に入りの状態を再取得して色を更新する
            fetchUserFavoritesAndUpdateColors();
        })
        .catch(error => {
            console.error('Error', error);
        });
    }

    function fetchUserFavoritesAndUpdateColors() {
        console.log("Fetching user favorites...");
        // ユーザーのお気に入り情報を取得するAjaxリクエストを追加
        fetch('/user/favorites', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            console.log("Data received:", data);
            setFavoriteButtonColors(data); // お気に入りの状態を取得した後にハートの色を更新
        })
        .catch(error => {
            console.error('Error', error);
        });
    }

    // ページ読み込み時とお気に入り登録後にお気に入りの状態を取得し、ハートの色を設定
    fetchUserFavoritesAndUpdateColors();

    // お気に入り登録ボタンのクリックイベントのリスナー
    favoriteButtons.forEach(button => {
        console.log(`Shop ID of the clicked button: ${button.dataset.shopId}`);
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const shopId = button.dataset.shopId;
            updateDatabaseAndColors(shopId);
        },{ capture: true });
    });

    // ページがリロードされた場合を確認するログ
    window.addEventListener('beforeunload', function() {
        console.log('Page is about to be reloaded');
    });
});
