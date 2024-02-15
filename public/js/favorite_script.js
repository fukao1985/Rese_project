// お気に入り登録ボタンのクリックイベントのリスナーを追加
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            // お気に入り登録のためのデータを取得
            const shopId = button.dataset.shopId;

            // ここにconsole.log()を追加する
            console.log('ハートのボタンがクリックされました。ショップID:', shopId);

            // Ajaxリクエストを作成
            const xhr = new XMLHttpRequest();
            console.log('リクエストURL:', 'favorite/add');
            xhr.open('POST', 'favorite/add');
            xhr.setRequestHeader('Content-Type', 'application/json');
            // CSRFトークンを追加
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            console.log('CSRFトークン:', csrfToken);

            // レスポンスを受け取った際の処理
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message);
                    // ハートの色を変更
                    if (button.classList.contains('active')) {
                        button.classList.remove('active');
                    } else {
                        button.classList.add('active')
                    }
                } else {
                    alert('エラーが発生しました');
                }
            };

            // リクエストを送信
            xhr.send(JSON.stringify({ shop_id: shopId }));
            console.log('リクエストデータ:', { shop_id: shopId });
        });
    });
});