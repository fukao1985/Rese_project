document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    console.log(favoriteButtons);
    console.log("adding active class");
    console.log("removing active class");

    function setFavoriteButtonColors() {
        fetch('/user/favorites', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            console.log("Data received:", data); // デバッグ用：データを確認
            favoriteButtons.forEach(button => {
                const shopId = button.dataset.shopId;
                console.log("Current shopId:", shopId); // デバッグ用：現在処理している店舗IDを確認
                if (data.includes(parseInt(shopId))) {
                    console.log("Adding active class"); // デバッグ用：activeクラスを追加する旨を確認
                    button.classList.add('active');
                } else {
                    console.log("Removing active class"); // デバッグ用：activeクラスを削除する旨を確認
                    button.classList.remove('active');
                }
            });
        })
        .catch(error => {
            console.error('Error', error);
        });
    }

    // ページ読み込み時にお気に入り登録状況を取得してハートの色を設定
    setFavoriteButtonColors();

    // お気に入り登録ボタンのクリックイベントのリスナー
    favoriteButtons.forEach(button => {
        console.log(button.dataset.shopId);
        button.addEventListener('click', function (event) {
            event.preventDefault();

            // お気に入り登録のためのデータを取得
            const shopId = button.dataset.shopId;

            // ハートの色を変更する前にお気に入り登録を行う
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
                // お気に入り登録後に色を更新する
                setFavoriteButtonColors();
            })
            .catch(error => {
                console.error('Error', error);
            });
        },{ capture: true });
    });
});
